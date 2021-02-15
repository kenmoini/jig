<?php

namespace App\Console\Commands;

use App\User;
use App\Setting;
use Carbon\Carbon;
use Illuminate\Console\Command;
use Illuminate\Database\Console\Migrations\BaseCommand;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Schema;

class InitialSetup extends BaseCommand
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'initial-setup:run {--database= : The database connection to use.}
    {--path= : The path of migrations files to be executed.}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Run Jig initial set up - requires database configuration to be set at least';

    /**
     * The migrator instance.
     *
     * @var \Illuminate\Database\Migrations\Migrator
     */
    protected $migrator;

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();

        $this->migrator = app('migrator');
    }


    /**
     * Checks to see if there are any migrations waiting to be run
     * 
     * @return bool
     */
    public function migrationCheckHandler() {
      $this->migrator->setConnection($this->option('database'));

      $files = $this->migrator->getMigrationFiles($this->getMigrationPaths());

      $pendingMigrations = array_diff(
          array_keys($files),
          $this->getRanMigrations()
      );

      if ($pendingMigrations) {
          $this->table(['Pending migrations'], array_map(function ($migration) {
              return [ $migration ];
          }, $pendingMigrations));

          return 1;
      }

      $this->info('No pending migrations.');

      return 0;
    }

    /**
     * Gets ran migrations with repository check
     * 
     * @return array
     */
    public function getRanMigrations()
    {
        if (! $this->migrator->repositoryExists()) {
            return [];
        }

        return $this->migrator->getRepository()->getRan(); 
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
      //=========================================================================================
      // Check for DB Connection
      try {
        $pdoTest = DB::connection()->getPdo();
        if ($pdoTest) {
          $this->info('Database connection established successfully...');
        }
      } catch (\Exception $e) {
        die("Could not connect to the database.  Please check your configuration. error:" . $e );
      }

      //=========================================================================================
      // Check for remaining migrations needing to be ran and run them
      $migrationCheck = $this->migrationCheckHandler();
      if ($migrationCheck) {
        $this->call('migrate');
      }

      //=========================================================================================
      // Check for DB Users Table - Number of Rows > 0
      // Admin user generation only occurs automatically if there are no users in teh database at all, ie fresh OOTB install
      try {
        $user = User::where('id', '>', 0)->first();
        if ($user) {
          $this->info('Users exist, skipping initial admin generation...');
        }
        else {
          $this->info('Users table is empty, running initial admin generation...');
          
          $user = new User;
          $user->name = env('ADMIN_USER_NAME', 'Administrator');
          $user->email = env('ADMIN_USER_EMAIL', 'admin@admin.com');
          $user->email_verified_at = Carbon::now()->toDateTimeString();

          // Check for write permissions for admin password file
          if (touch(storage_path('app/generated_admin_password'))) {
            if (env('ADMIN_USER_PASSWORD')) {
              $password = env('ADMIN_USER_PASSWORD', 'Passw0rd1!');
            }
            $password = substr(str_replace(['+', '/', '='], '', base64_encode(random_bytes(32))), 0, 16); // 16 characters, without /=+
            $myfile = fopen(storage_path('app/generated_admin_password'), "w");
            fwrite($myfile, $password);
            fclose($myfile);
            $this->info('Admin password located at: ' . storage_path('app/generated_admin_password'));
          }
          else {
            $password = env('ADMIN_USER_PASSWORD', 'Passw0rd1!');
          }
          
          $user->password = Hash::make($password);
          $user->save();
          $this->info('Admin user ' . $user->email . ' generated!');
        }
      } catch (\Exception $e) {
        die("Exception while trying to find user count in table 'users'.  Please check your configuration. error:" . $e );
      }

      //=========================================================================================
      // Run Initial Setup Seeder
      $initialSetupSeeder = Artisan::call('db:seed', [
        '--class' => 'InitialSetupSeeder'
      ]);
    }
}

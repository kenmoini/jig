<?php

namespace App\Console\Commands;

use App\User;
use Carbon\Carbon;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Hash;

class InitialSetupCreateAdmin extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'initial-setup:create-admin-user {--name= : User Name} {--email= : User Email} {--password= : User Passord}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Create a new Administrative User in the internal authentication provider';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
      // Arguement check
      $email = $this->option('email');
      $name = $this->option('name');
      $password = $this->option('password');

      if (!$email || !$name || !$password) {
        $this->error("Arguments missing!");
      }
      else {
        $user = new User;
        $user->name = $name;
        $user->email = $email;
        $user->email_verified_at = Carbon::now()->toDateTimeString();
        $user->password = Hash::make($password);
        $user->save();
        $this->info('Admin user ' . $user->email . ' generated!');
      }
    }
}

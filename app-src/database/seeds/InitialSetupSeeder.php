<?php

use App\Setting;
use Illuminate\Database\Seeder;

class InitialSetupSeeder extends Seeder
{

    public $globalSettings = [
      ['key' => 'user.registration.default-group-id', 'value' => 2, 'description' => 'The default Group ID for newly registered users.']
    ];

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
      // Check for global.initial_setup_ran in Settings
      $initialSetupRan = Setting::where('key', 'global.initial_setup_ran')->get();
      if ($initialSetupRan->count()) {
        echo 'Global Settings Database seeding already completed! Skipping...' . "\n";
      }
      else {
        DB::table('settings')->insert([
          'key' => 'global.initial_setup_ran',
          'value' => '1',
          'description' => 'Flag for if the initial set up has been run',
        ]);
      }
      foreach ($this->globalSettings as $setting) {
        $check = DB::table('settings')->where('key',$setting['key'])->first();
        if (!$check) {
          DB::table('settings')->insert([
            'key' => $setting['key'],
            'value' => $setting['value'],
            'description' => $setting['description'],
          ]);
        }
      }

      // Check for workshop_seeder.ran in Settings
      $workshopSeederRan = Setting::where('key', 'workshop_seeder.ran')->get();
      if ($workshopSeederRan->count()) {
        echo 'Workshop Database seeding already completed! Skipping...' . "\n";
      }
      else {
        $seeder = $this->call(WorkshopSeeder::class);
        if ($seeder) {
          DB::table('settings')->insert([
            'key' => 'workshop_seeder.ran',
            'value' => '1',
            'description' => 'Flag for if the Workshop Database Seeder Data has been inserted',
          ]);
        }
      }

      // Check for asset_seeder.ran in Settings
      $assetSeederRan = Setting::where('key', 'asset_seeder.ran')->get();
      if ($assetSeederRan->count()) {
        echo 'Workshop Asset Database seeding already completed! Skipping...' . "\n";
      }
      else {
        $assetSeeder = $this->call(AssetSeeder::class);
        if ($assetSeeder) {
          DB::table('settings')->insert([
            'key' => 'asset_seeder.ran',
            'value' => '1',
            'description' => 'Flag for if the Workshop Asset Database Seeder Data has been inserted',
          ]);
        }
      }

      $authorizationSeeder = $this->call(AuthorizationSeeder::class);

      echo 'Initial Setup Database seeding successfully completed!' . "\n";

    }
}

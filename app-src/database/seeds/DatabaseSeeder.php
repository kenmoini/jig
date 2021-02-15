<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call(InitialSetupSeeder::class);
        //$this->call(WorkshopSeeder::class);
        //$this->call(AssetSeeder::class);
    }
}

<?php

use App\User;
use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class AdminUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $user = new User;
        $user->name = "Administrator";
        $user->email = "admin@admin.com";
        $user->password = Hash::make('Passw0rd1!');
        $user->email_verified_at = Carbon::now()->toDateTimeString();
        $user->save();
    }
}

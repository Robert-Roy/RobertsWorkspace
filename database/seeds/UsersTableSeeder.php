<?php

use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([
            'name' => env('DEFAULT_SITE_ADMIN_USERNAME'),
            'email' => env('DEFAULT_SITE_ADMIN_EMAIL'),
            'password' => Hash::make(env('DEFAULT_SITE_ADMIN_PASSWORD'))
        ]);
    }
}

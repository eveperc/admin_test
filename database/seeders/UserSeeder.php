<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \DB::table('users')->insert([
          'name' => 'user',
          'email' => 'info@user.com',
          'password' => \Hash::make('user'),
        ]);
    }
}

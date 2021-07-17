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
        'name' => 'ユーザー',
        'email' => 'eve.perc@gmail.com',
        'password' => \Hash::make('user'),
      ]);
    }
}

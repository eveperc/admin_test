<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class CompanySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
      \DB::table('companies')->insert([
        'name' => 'company',
        'email' => 'info@company.com',
        'password' => \Hash::make('company'),
      ]);
      \DB::table('companies')->insert([
        'name' => 'company2',
        'email' => 'info2@company.com',
        'password' => \Hash::make('company'),
      ]);
      \DB::table('companies')->insert([
        'name' => 'company3',
        'email' => 'info3@company.com',
        'password' => \Hash::make('company'),
      ]);
    }
}

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
    }
}

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
        'name' => '法人',
        'email' => 'atcell2nd@gmail.com',
        'password' => \Hash::make('company'),
      ]);
    }
}

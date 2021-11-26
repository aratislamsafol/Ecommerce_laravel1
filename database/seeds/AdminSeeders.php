<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
class AdminSeeders extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('admins')->insert([
            'name' => 'arat_admin',
            'email' =>'arat_admin@gmail.com',
            'password' => Hash::make('password'),
            'phone' => '01969545000',
        ]);
    }
}

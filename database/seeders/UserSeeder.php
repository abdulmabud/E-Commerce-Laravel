<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //Admin Register
        DB::table('users')->insert([
            'name' => 'Mr Admin',
            'email' => 'admin@abdulmabud.com',
            'phone' => '01700-000000',
            'address' => 'Dhaka, Bangladesh',
            'password' => Hash::make('admin@123'),
            'is_admin' => 1,
        ]);

        //Normal User Register

        DB::table('users')->insert([
            'name' => 'Normal User',
            'email' => 'user@abdulmabud.com',
            'phone' => '01900-000000',
            'address' => 'Dhaka, Bangladesh',
            'password' => Hash::make('123456'),
        ]);
    }
}

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
        DB::table('users')->insert([
            'name' => 'Admin',
            'email' => 'admin@gmail.com',
            'password' => Hash::make('admin123'),
            'gender' => 'Male',
        ]);
        DB::table('users')->insert([
            'name' => 'Adrian',
            'email' => 'adrian@gmail.com',
            'password' => Hash::make('adrian123'),
            'gender' => 'Male',
        ]);
        DB::table('users')->insert([
            'name' => 'Caca',
            'email' => 'caca@gmail.com',
            'password' => Hash::make('caca1234'),
            'gender' => 'Female',
        ]);
    }
}

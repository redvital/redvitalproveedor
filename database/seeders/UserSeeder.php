<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

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
            'name' => "admin1",
            'email' => 'admin123@gmail.com',
            'password' => Hash::make('123456789'),
            'role' => 'admin'
        ]);
        DB::table('users')->insert([
            'name' => "admin2",
            'email' => 'admin2@gmail.com',
            'password' => Hash::make('123456789'),
            
        ]);
    }
}

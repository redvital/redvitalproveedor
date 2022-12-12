<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;


class ProveedorSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('providers')->insert([
            'name' => "gatos1",
            'email' => "gatos123@gmail.com",
            'phone_number' => "123123123",
            'company' => "123123123",
            'rif' => "J-223467824" ,
            'provider_type' => "2",
            'user_id' => "1",
        ]);
        DB::table('providers')->insert([
            'name' => "gatos2",
            'email' => "gatos@gmail.com",
            'phone_number' => "123123123",
            'company' => "123123123",
            'rif' => "J-22346726" ,
            'provider_type' => "2",
            'user_id' => "1",
        ]);
    }
}

<?php

namespace Database\Seeders;

use Illuminate\Support\Carbon;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class StateSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('states')->insert([
            'state' => 'Amazonas',
            'created_at' => Carbon::now()
        ]);

        DB::table('states')->insert([
            'state' => 'Anzoátegui',
            'created_at' => Carbon::now()
        ]);

        DB::table('states')->insert([
            'state' => 'Apure',
            'created_at' => Carbon::now()
        ]);

        DB::table('states')->insert([
            'state' => 'Aragua',
            'created_at' => Carbon::now()
        ]);

        DB::table('states')->insert([
            'state' => 'Barinas',
            'created_at' => Carbon::now()
        ]);

        DB::table('states')->insert([
            'state' => 'Bolívar',
            'created_at' => Carbon::now()
        ]);

        DB::table('states')->insert([
            'state' => 'Carabobo',
            'created_at' => Carbon::now()
        ]);

        DB::table('states')->insert([
            'state' => 'Cojedes',
            'created_at' => Carbon::now()
        ]);

        DB::table('states')->insert([
            'state' => 'Delta Amacuro',
            'created_at' => Carbon::now()
        ]);

        DB::table('states')->insert([
            'state' => 'Distrito Federal',
            'created_at' => Carbon::now()
        ]);

        DB::table('states')->insert([
            'state' => 'Falcón',
            'created_at' => Carbon::now()
        ]);

        DB::table('states')->insert([
            'state' => 'Guárico',
            'created_at' => Carbon::now()
        ]);

        DB::table('states')->insert([
            'state' => 'Lara',
            'created_at' => Carbon::now()
        ]);

        DB::table('states')->insert([
            'state' => 'Mérida',
            'created_at' => Carbon::now()
        ]);

        DB::table('states')->insert([
            'state' => 'Miranda',
            'created_at' => Carbon::now()
        ]);

        DB::table('states')->insert([
            'state' => 'Monagas',
            'created_at' => Carbon::now()
        ]);

        DB::table('states')->insert([
            'state' => 'Nueva Esparta',
            'created_at' => Carbon::now()
        ]);

        DB::table('states')->insert([
            'state' => 'Portuguesa',
            'created_at' => Carbon::now()
        ]);

        DB::table('states')->insert([
            'state' => 'Sucre',
            'created_at' => Carbon::now()
        ]);

        DB::table('states')->insert([
            'state' => 'Táchira',
            'created_at' => Carbon::now()
        ]);

        DB::table('states')->insert([
            'state' => 'Trujillo',
            'created_at' => Carbon::now()
        ]);

        DB::table('states')->insert([
            'state' => 'Vargas',
            'created_at' => Carbon::now()
        ]);

        DB::table('states')->insert([
            'state' => 'Yaracuy',
            'created_at' => Carbon::now()
        ]);

        DB::table('states')->insert([
            'state' => 'Zulia',
            'created_at' => Carbon::now()
        ]);
    }
}

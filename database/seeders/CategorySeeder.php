<?php

namespace Database\Seeders;

use Illuminate\Support\Carbon;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
            DB::table('categories')->insert([
                'name' => 'ALIMENTOS',
                'description' => 'ALIMENTOS',
                'created_at' => Carbon::now()
            ]);
            DB::table('categories')->insert([
                'name' => 'COSMETICOS Y BELLEZA',
                'description' => 'COSMETICOS Y BELLEZA',
                'created_at' => Carbon::now()
            ]);
            DB::table('categories')->insert([
                'name' => 'CUIDADO E HIGIENE PERSONAL',
                'description' => 'CUIDADO E HIGIENE PERSONAL',
                'created_at' => Carbon::now()
            ]);
            DB::table('categories')->insert([
                'name' => 'DERMATOLOGIA Y ESTETICA',
                'description' => 'DERMATOLOGIA Y ESTETICA',
                'created_at' => Carbon::now()
            ]);
            DB::table('categories')->insert([
                'name' => 'EQUIPOS MEDICOS',
                'description' => 'EQUIPOS MEDICOS',
                'created_at' => Carbon::now()
            ]);
            DB::table('categories')->insert([
                'name' => 'INSTRUMENTAL',
                'description' => 'INSTRUMENTAL',
                'created_at' => Carbon::now()
            ]);
            DB::table('categories')->insert([
                'name' => 'INSUMOS MEDICO',
                'description' => 'INSUMOS MEDICO',
                'created_at' => Carbon::now()
            ]);
            DB::table('categories')->insert([
                'name' => 'MEDICAMENTOS',
                'description' => 'MEDICAMENTOS',
                'created_at' => Carbon::now()
            ]);
            DB::table('categories')->insert([
                'name' => 'MATERNITY',
                'description' => 'MATERNITY',
                'created_at' => Carbon::now()
            ]);
            DB::table('categories')->insert([
                'name' => 'BABY & CHILD',
                'description' => 'BABY & CHILD',
                'created_at' => Carbon::now()
            ]);
            DB::table('categories')->insert([
                'name' => 'MISCELANEOS',
                'description' => 'MISCELANEOS',
                'created_at' => Carbon::now()
            ]);
            DB::table('categories')->insert([
                'name' => 'ODONTOLOGIA',
                'description' => 'ODONTOLOGIA',
                'created_at' => Carbon::now()
            ]);
            DB::table('categories')->insert([
                'name' => 'HOGAR',
                'description' => 'HOGAR',
                'created_at' => Carbon::now()
            ]);
            DB::table('categories')->insert([
                'name' => 'SPA',
                'description' => 'SPA',
                'created_at' => Carbon::now()
            ]);
            DB::table('categories')->insert([
                'name' => 'SPORT & FITNESS',
                'description' => 'SPORT & FITNESS',
                'created_at' => Carbon::now()
            ]);
            DB::table('categories')->insert([
                'name' => 'VESTIMENTA',
                'description' => 'VESTIMENTA',
                'created_at' => Carbon::now()
            ]);
            DB::table('categories')->insert([
                'name' => 'VETERINARIA',
                'description' => 'VETERINARIA',
                'created_at' => Carbon::now()
            ]);
            DB::table('categories')->insert([
                'name' => 'VITAMINAS',
                'description' => 'VITAMINAS',
                'created_at' => Carbon::now()
            ]);
            DB::table('categories')->insert([
                'name' => 'MINERALES Y SUPLEMENTOS',
                'description' => 'MINERALES Y SUPLEMENTOS',
                'created_at' => Carbon::now()
            ]);
    }
}

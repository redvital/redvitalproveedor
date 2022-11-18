<?php

namespace Database\Seeders;

use Illuminate\Support\Carbon;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class BankSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
         DB::table('banks')->insert([
            'code' => '0156',
            'bank' => '100% BANCO',
            'created_at' => Carbon::now()
        ]);
        DB::table('banks')->insert([
            'code' => '0196',
            'bank' => 'ABN AMRO BANK',
            'created_at' => Carbon::now()
        ]);
         DB::table('banks')->insert([
            'code' => '0172',
            'bank' => 'BANCAMIGA BANCO MICROFINANCIERO',
            'created_at' => Carbon::now()
        ]);
         DB::table('banks')->insert([
            'code' => '0171',
            'bank' => 'BANCO ACTIVO BANCO COMERCIAL',
            'created_at' => Carbon::now()
        ]);
         DB::table('banks')->insert([
            'code' => '0166',
            'bank' => 'BANCO AGRICOLA',
            'created_at' => Carbon::now()
        ]);
         DB::table('banks')->insert([
            'code' => '0175',
            'bank' => 'BANCO BICENTENARIO',
            'created_at' => Carbon::now()
        ]);
         DB::table('banks')->insert([
            'code' => '0128',
            'bank' => 'BANCO CARONI BANCO UNIVERSAL',
            'created_at' => Carbon::now()
        ]);
         DB::table('banks')->insert([
            'code' => '0164',
            'bank' => 'BANCO DE DESARROLLO DEL MICROEMPRESARIO',
            'created_at' => Carbon::now()
        ]);
         DB::table('banks')->insert([
            'code' => '0102',
            'bank' => 'BANCO DE VENEZUELA',
            'created_at' => Carbon::now()
        ]);
         DB::table('banks')->insert([
            'code' => '0114',
            'bank' => 'BANCO DEL CARIBE',
            'created_at' => Carbon::now()
        ]);
         DB::table('banks')->insert([
            'code' => '0149',
            'bank' => 'BANCO DEL PUEBLO SOBERANO',
            'created_at' => Carbon::now()
        ]);
         DB::table('banks')->insert([
            'code' => '0163',
            'bank' => 'BANCO DEL TESORO',
            'created_at' => Carbon::now()
        ]);
         DB::table('banks')->insert([
            'code' => '0176',
            'bank' => 'BANCO ESPIRITO SANTO',
            'created_at' => Carbon::now()
        ]);
         DB::table('banks')->insert([
            'code' => '0115',
            'bank' => 'BANCO EXTERIOR',
            'created_at' => Carbon::now()
        ]);
         DB::table('banks')->insert([
            'code' => '0003',
            'bank' => 'BANCO INDUSTRIAL DE VENEZUELA',
            'created_at' => Carbon::now()
        ]);
         DB::table('banks')->insert([
            'code' => '0173',
            'bank' => 'BANCO INTERNACIONAL DE DESARROLLO',
            'created_at' => Carbon::now()
        ]);
         DB::table('banks')->insert([
            'code' => '0105',
            'bank' => 'BANCO MERCANTIL',
            'created_at' => Carbon::now()
        ]);
         DB::table('banks')->insert([
            'code' => '0191',
            'bank' => 'BANCO NACIONAL DE CREDITO',
            'created_at' => Carbon::now()
        ]);
         DB::table('banks')->insert([
            'code' => '0116',
            'bank' => 'BANCO OCCIDENTAL DE DESCUENTO',
            'created_at' => Carbon::now()
        ]);
         DB::table('banks')->insert([
            'code' => '0138',
            'bank' => 'BANCO PLAZA',
            'created_at' => Carbon::now()
        ]);
         DB::table('banks')->insert([
            'code' => '0108',
            'bank' => 'BANCO PROVINCIAL BBVA',
            'created_at' => Carbon::now()
        ]);
         DB::table('banks')->insert([
            'code' => '0104',
            'bank' => 'BANCO VENEZOLANO DE CREDITO',
            'created_at' => Carbon::now()
        ]);
         DB::table('banks')->insert([
            'code' => '0168',
            'bank' => 'BANCRECER BANCO DE DESARROLLO',
            'created_at' => Carbon::now()
        ]);
         DB::table('banks')->insert([
            'code' => '0134',
            'bank' => 'BANESCO BANCO UNIVERSAL',
            'created_at' => Carbon::now()
        ]);
         DB::table('banks')->insert([
            'code' => '0177',
            'bank' => 'BANFANB',
            'created_at' => Carbon::now()
        ]);
         DB::table('banks')->insert([
            'code' => '0146',
            'bank' => 'BANGENTE',
            'created_at' => Carbon::now()
        ]);
         DB::table('banks')->insert([
            'code' => '0174',
            'bank' => 'BANPLUS BANCO COMERCIAL',
            'created_at' => Carbon::now()
        ]);
         DB::table('banks')->insert([
            'code' => '0190',
            'bank' => 'CITIBANK',
            'created_at' => Carbon::now()
        ]);
         DB::table('banks')->insert([
            'code' => '0121',
            'bank' => 'CORPBANCA',
            'created_at' => Carbon::now()
        ]);
         DB::table('banks')->insert([
            'code' => '0157',
            'bank' => 'DELSUR BANCO UNIVERSAL',
            'created_at' => Carbon::now()
        ]);
         DB::table('banks')->insert([
            'code' => '0151',
            'bank' => 'FONDOCOMUN',
            'created_at' => Carbon::now()
        ]);
         DB::table('banks')->insert([
            'code' => '0601',
            'bank' => 'INSTITUTO MUNICIPAL DE CREDITO POPULAR',
            'created_at' => Carbon::now()
        ]);
         DB::table('banks')->insert([
            'code' => '0169',
            'bank' => 'MI BANCO BANCO DE DESARROLLO',
            'created_at' => Carbon::now()
        ]);
         DB::table('banks')->insert([
            'code' => '0137',
            'bank' => 'SOFITASA',
            'created_at' => Carbon::now()
        ]);
    }
}

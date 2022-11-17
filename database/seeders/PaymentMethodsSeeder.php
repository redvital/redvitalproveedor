<?php

namespace Database\Seeders;

use Illuminate\Support\Carbon;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class PaymentMethodsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('payment_methods')->insert([
            'payment_method' => 'Efectivo',
            'created_at' => Carbon::now()
        ]);
        DB::table('payment_methods')->insert([
            'payment_method' => 'Transferencia Bancaria',
            'created_at' => Carbon::now()
        ]);
        DB::table('payment_methods')->insert([
            'payment_method' => 'Zelle',
            'created_at' => Carbon::now()
        ]);
        DB::table('payment_methods')->insert([
            'payment_method' => 'Tranferencia Internacional',
            'created_at' => Carbon::now()
        ]);
        DB::table('payment_methods')->insert([
            'payment_method' => 'Pago Movil',
            'created_at' => Carbon::now()
        ]);
    }
}

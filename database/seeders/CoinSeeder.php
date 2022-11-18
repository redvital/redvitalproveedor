<?php

namespace Database\Seeders;

use Illuminate\Support\Carbon;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class CoinSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
         DB::table('coins')->insert([
            'coin' => 'VES',
            'created_at' => Carbon::now()
         ]);
         DB::table('coins')->insert([
            'coin' => 'USD',
            'created_at' => Carbon::now()
         ]);
    }
}

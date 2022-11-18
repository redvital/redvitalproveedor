<?php

namespace Database\Seeders;

use Illuminate\Support\Carbon;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class ConditionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
            DB::table('conditions')->insert([
                'condition' => 'Agravable',
                'created_at' => Carbon::now()
            ]);
            DB::table('conditions')->insert([
                'condition' => 'Excento',
                'created_at' => Carbon::now()
            ]);
    }
}

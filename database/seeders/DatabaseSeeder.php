<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call(StateSeeder::class);
        $this->call(BankSeeder::class);
        $this->call(CoinSeeder::class);
        $this->call(ConditionSeeder::class);
        $this->call(CategorySeeder::class);
        $this->call(PaymentMethodsSeeder::class);
    }
}

// git add test


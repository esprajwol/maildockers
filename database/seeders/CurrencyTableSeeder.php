<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Currency;
use Illuminate\Support\Facades\Hash;

class CurrencyTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $currencies = Currency::query()->get();
        if ($currencies->count() <= 0) {
            $currency = [
                ["id"=>"1","country"=>"United Kingdom","currency"=>"Pound Sterling","code"=>"GBP","minor_unit"=>"2","symbol"=>"£"],
                ["id"=>"2","country"=>"Israel","currency"=>"New Israeli Sheqel","code"=>"ILS","minor_unit"=>"2","symbol"=>"₪"],

                ];

            Currency::query()->insert($currency);
        }

    }
}

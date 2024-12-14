<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CountryStateSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::statement('SET FOREIGN_KEY_CHECKS=0;');

        // Truncate both tables to prevent duplicates
        DB::table('states')->truncate();
        DB::table('countries')->truncate();

        // Insert countries
        $countries = [
            ['id' => 1, 'name' => 'United Kingdom', 'code' => 'GB', 'flag' => '🇬🇧', 'language_code' => 'en'],
            ['id' => 2, 'name' => 'Israel', 'code' => 'IL', 'flag' => '🇮🇱', 'language_code' => 'he'],
        ];

        DB::table('countries')->insert($countries);

        // Insert states corresponding to the countries
        $states = [
            // States for United Kingdom (id = 1)
            ['country_id' => 1, 'name' => 'London'],
            ['country_id' => 1, 'name' => 'Manchester'],
            ['country_id' => 1, 'name' => 'Birmingham'],
            ['country_id' => 1, 'name' => 'Liverpool'],
            ['country_id' => 1, 'name' => 'Edinburgh'],

            // States for Israel (id = 2)
            ['country_id' => 2, 'name' => 'Jerusalem'],
            ['country_id' => 2, 'name' => 'Tel Aviv'],
            ['country_id' => 2, 'name' => 'Haifa'],
            ['country_id' => 2, 'name' => 'Eilat'],
            ['country_id' => 2, 'name' => 'Beersheba'],
        ];

        DB::table('states')->insert($states);

        DB::statement('SET FOREIGN_KEY_CHECKS=1;');
    }
}

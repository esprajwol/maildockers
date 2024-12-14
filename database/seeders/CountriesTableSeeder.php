<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CountriesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::statement('SET FOREIGN_KEY_CHECKS=0;');
        DB::table('countries')->truncate();

        $countries = [
            ['name' => 'United Kingdom', 'code' => 'GB', 'flag' => '🇬🇧', 'language_code' => 'en'],
            ['name' => 'Israel', 'code' => 'IL', 'flag' => '🇮🇱', 'language_code' => 'he'],
        ];

        DB::table('countries')->insert($countries);
        DB::statement('SET FOREIGN_KEY_CHECKS=1;');
    }
}

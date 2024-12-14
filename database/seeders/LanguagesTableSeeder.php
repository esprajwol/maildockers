<?php

namespace Database\Seeders;

use App\Models\Language;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class LanguagesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::statement('SET FOREIGN_KEY_CHECKS=0;');
        DB::table('languages')->truncate();

        $languages = [
            ['name' => 'English', 'code' => 'en', 'direction' => 'ltr'],
            ['name' => 'Hebrew', 'code' => 'he', 'direction' => 'rtl'],
        ];

        Language::insert($languages);
        DB::statement('SET FOREIGN_KEY_CHECKS=1;');
    }
}

<?php

namespace Database\Seeders\pushData;

use App\Models\Language\Language;
use Illuminate\Database\Seeder;

class LanguageSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $languages = [
            ['code' => 'en', 'name' => 'English'],
            ['code' => 'es', 'name' => 'Spanish'],
            ['code' => 'fr', 'name' => 'French'],
            ['code' => 'ru', 'name' => 'Russian'],
        ];

        foreach ($languages as $language) {
            Language::create($language);
        }
    }
}

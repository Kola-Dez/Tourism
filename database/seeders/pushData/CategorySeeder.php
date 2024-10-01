<?php

namespace Database\Seeders\pushData;

use App\Models\Category\Category;
use App\Models\CategoryTranslation\CategoryTranslation;
use App\Models\Language\Language;
use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Создаем направления
        $categories = [
            ['title' => 'Category1', 'image' => 'paris.jpg', 'description' => 'The city of light.'],
            ['title' => 'Category2', 'image' => 'tokyo.jpg', 'description' => 'A bustling metropolis.'],
            ['title' => 'Category3', 'image' => 'newyork.jpg', 'description' => 'The Big Apple.'],
        ];

        foreach ($categories as $categoryData) {
            $category = Category::create($categoryData);

            // Добавляем переводы для каждого направления
            foreach (Language::all() as $language) {
                $translatedName = $categoryData['title'] . ' (' . $language->name . ')';
                CategoryTranslation::create([
                    'category_id' => $category->id,
                    'language_id' => $language->id,
                    'translate_title' => $translatedName,
                    'translate_description' => $translatedName,
                ]);
            }
        }
    }
}

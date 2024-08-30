<?php

namespace Database\Seeders\pushData;

use App\Models\Category\Category;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\File;

class CategorySeeder extends Seeder
{
    /**
     * Seed the categories table.
     *
     * @return void
     */
    public function run(): void
    {
        $categories = [
            [
                'title' => 'Winter Tours',
                'slug' => 'Winter Tours',
            ],
            [
                'title' => 'Bike Tours',
                'slug' => 'Bike Tours',
            ],
            [
                'title' => 'Horseback Tours',
                'slug' => 'Horseback Tours',
            ],
            [
                'title' => 'Group Tours',
                'slug' => 'Group Tours',
            ],
            [
                'title' => 'Off Road Tours',
                'slug' => 'Off Road Tours',
            ],
            [
                'title' => 'Culture Tours',
                'slug' => 'Culture Tours',
            ],
            [
                'title' => 'Photo Tours',
                'slug' => 'Photo Tours',
            ],
            [
                'title' => 'One Day Tours',
                'slug' => 'One Day Tours',
            ],
        ];

        if (!File::exists(public_path('images/category'))) {
            File::makeDirectory(public_path('images/category'), 0755, true);
        }

        foreach ($categories as $category) {
            $this->createCategory($category);
        }
    }

    public function createCategory(array $category): void
    {

        Category::create([
            'title' => $category['title'],
            'slug' => $category['slug'],
        ]);
    }
}

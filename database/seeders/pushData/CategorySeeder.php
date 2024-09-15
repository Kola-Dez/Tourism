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
                'image' => 'Winter image',
            ],
            [
                'title' => 'Bike Tours',
                'slug' => 'Bike Tours',
                'image' => 'Winter image',
            ],
            [
                'title' => 'Horseback Tours',
                'slug' => 'Horseback Tours',
                'image' => 'Winter image',
            ],
            [
                'title' => 'Group Tours',
                'slug' => 'Group Tours',
                'image' => 'Winter image',
            ],
            [
                'title' => 'Off Road Tours',
                'slug' => 'Off Road Tours',
                'image' => 'Winter image',
            ],
            [
                'title' => 'Culture Tours',
                'slug' => 'Culture Tours',
                'image' => 'Winter image',
            ],
            [
                'title' => 'Photo Tours',
                'slug' => 'Photo Tours',
                'image' => 'Winter image',
            ],
            [
                'title' => 'One Day Tours',
                'slug' => 'One Day Tours',
                'image' => 'Winter image',
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
            'image' => $category['image'],
        ]);
    }
}

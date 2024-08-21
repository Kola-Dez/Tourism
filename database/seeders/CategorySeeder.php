<?php

namespace Database\Seeders;

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
                'image' => 'winterTours.png'
            ],
            [
                'title' => 'Bike Tours',
                'slug' => 'Bike Tours',
                'image' => 'bikeTours.png'
            ],
            [
                'title' => 'Horseback Tours',
                'slug' => 'Horseback Tours',
                'image' => 'horsebackTours.png'
            ],
            [
                'title' => 'Group Tours',
                'slug' => 'Group Tours',
                'image' => 'groupTours.png'
            ],
            [
                'title' => 'Off Road Tours',
                'slug' => 'Off Road Tours',
                'image' => 'offRoadTours.png'
            ],
            [
                'title' => 'Culture Tours',
                'slug' => 'Culture Tours',
                'image' => 'cultureTours.png'
            ],
            [
                'title' => 'Photo Tours',
                'slug' => 'Photo Tours',
                'image' => 'photoTours.png'
            ],
            [
                'title' => 'One Day Tours',
                'slug' => 'One Day Tours',
                'image' => 'oneDayTours.png'
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
            'image' => '/images/category/' . $category['image'],
        ]);
    }
}

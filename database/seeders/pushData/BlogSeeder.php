<?php

namespace Database\Seeders\pushData;

use App\Models\Blog\Blog;
use Illuminate\Database\Seeder;

class BlogSeeder extends Seeder
{
    /**
     * Seed the group_tour_itineraries table.
     *
     * @return void
     */
    public function run(): void
    {
        $blogs = [
            [
                'image' => 'test.png',
                'destination_id' => 1,
                'title' => 'title 1 for 1',
                'description' => 'test description 1 for 1',
            ],
            [
                'image' => 'test.png',
                'destination_id' => 1,
                'title' => 'title 1 for 1',
                'description' => 'test description 1 for 1',
            ],
            [
                'image' => 'test.png',
                'destination_id' => 1,
                'title' => 'title 1 for 1',
                'description' => 'test description 1 for 1',
            ],
            [
                'image' => 'test.png',
                'destination_id' => 1,
                'title' => 'title 1 for 1',
                'description' => 'test description 1 for 1',
            ],
            [
                'image' => 'test.png',
                'destination_id' => 1,
                'title' => 'title 1 for 1',
                'description' => 'test description 1 for 1',
            ],
            [
                'image' => 'test.png',
                'destination_id' => 1,
                'title' => 'title 1 for 1',
                'description' => 'test description 1 for 1',
            ],
            [
                'image' => 'test.png',
                'destination_id' => 1,
                'title' => 'title 1 for 1',
                'description' => 'test description 1 for 1',
            ],
            [
                'image' => 'test.png',
                'destination_id' => 1,
                'title' => 'title 1 for 1',
                'description' => 'test description 1 for 1',
            ],
        ];

        foreach ($blogs as $blog) {
            $this->createItineraryGroupTour($blog);
        }
    }

    public function createItineraryGroupTour(array $blog): void
    {
        Blog::create([
            'image' => $blog['image'],
            'destination_id' => $blog['destination_id'],
            'title' => $blog['title'],
            'description' => $blog['description'],
        ]);
    }
}

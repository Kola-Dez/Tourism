<?php

namespace Database\Seeders\pushData;

use App\Models\Tours\GroupTour;
use Illuminate\Database\Seeder;

class GroupTourSeeder extends Seeder
{
    /**
     * Seed the categories table.
     *
     * @return void
     */
    public function run(): void
    {
        $groupTours = [
            [
                'category_id' => 1,
                'travel_destination_id' => 1,
                'title' => 'TestPrivateTours',
                'image' => 'Test.png',
                'description' => 'Test test hello this is test description',
                'inclusions' => 'this inclusions',
                'exclusions' => 'this exclusions',
                'price' => 10000,
                'how_many_peoples' => 10,
                'hits' => 0,
                'status' => 'available',
                'departing' => now()->toDateString(),
                'finishing' => now()->addDays(5)->toDateString(),
            ],
            [
                'category_id' => 1,
                'travel_destination_id' => 1,
                'title' => 'TestPrivateTours2',
                'image' => 'Test2.png',
                'description' => 'Test test hello this is test description2',
                'inclusions' => 'this inclusions2',
                'exclusions' => 'this exclusions2',
                'price' => 20000,
                'how_many_peoples' => 5,
                'hits' => 1,
                'status' => 'available',
                'departing' => now()->toDateString(),
                'finishing' => now()->addDays(5)->toDateString(),
            ],
            [
                'category_id' => 1,
                'travel_destination_id' => 1,
                'title' => 'TestPrivateTours3',
                'image' => 'Test3.png',
                'description' => 'Test test hello this is test description3',
                'inclusions' => 'this inclusions3',
                'exclusions' => 'this exclusions3',
                'price' => 20000,
                'how_many_peoples' => 4,
                'hits' => 3,
                'status' => 'available',
                'departing' => now()->toDateString(),
                'finishing' => now()->addDays(5)->toDateString(),
            ],
            [
                'category_id' => 1,
                'travel_destination_id' => 1,
                'title' => 'TestPrivateTours4',
                'image' => 'Test4.png',
                'description' => 'Test test hello this is test description4',
                'inclusions' => 'this inclusions4',
                'exclusions' => 'this exclusions4',
                'price' => 20000,
                'how_many_peoples' => 7,
                'hits' => 6,
                'status' => 'unavailable',
                'departing' => now()->toDateString(),
                'finishing' => now()->addDays(5)->toDateString(),
            ],
        ];

        foreach ($groupTours as $groupTour) {
            $this->createPrivateTour($groupTour);
        }
    }

    public function createPrivateTour(array $groupTour): void
    {
        GroupTour::create([
            'category_id' => $groupTour['category_id'],
            'travel_destination_id' => $groupTour['travel_destination_id'],
            'title' => $groupTour['title'],
            'image' => $groupTour['image'],
            'description' => $groupTour['description'],
            'inclusions' => $groupTour['inclusions'],
            'exclusions' => $groupTour['exclusions'],
            'price' => $groupTour['price'],
            'how_many_peoples' => $groupTour['how_many_peoples'],
            'hits' => $groupTour['hits'],
            'status' => $groupTour['status'],
            'departing' => $groupTour['departing'],
            'finishing' => $groupTour['finishing'],
        ]);
    }
}

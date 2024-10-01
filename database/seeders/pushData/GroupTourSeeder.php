<?php

namespace Database\Seeders\pushData;

use App\Models\Tours\GroupTour;
use Illuminate\Database\Seeder;
use Carbon\Carbon;

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
                'images' => json_encode(['Test.png', 'Test.jpg']),
                'description' => 'Test test hello this is test description',
                'inclusions' => 'this inclusions',
                'exclusions' => 'this exclusions',
                'price' => 10000,
                'how_many_peoples' => 10,
                'hits' => 0,
                'status' => 'available',
                'departing' => Carbon::now()->format('Y-m-d'),
                'finishing' => Carbon::now()->addDays(5)->format('Y-m-d'),
            ],
            [
                'category_id' => 1,
                'travel_destination_id' => 2,
                'title' => 'TestPrivateTours2',
                'image' => 'Test2.png',
                'images' => json_encode(['Test1.png', 'Test1.jpg']),
                'description' => 'Test test hello this is test description2',
                'inclusions' => 'this inclusions2',
                'exclusions' => 'this exclusions2',
                'price' => 20000,
                'how_many_peoples' => 5,
                'hits' => 1,
                'status' => 'available',
                'departing' => Carbon::now()->format('Y-m-d'),
                'finishing' => Carbon::now()->addDays(5)->format('Y-m-d'),
            ],
            [
                'category_id' => 1,
                'travel_destination_id' => 1,
                'title' => 'TestPrivateTours3',
                'image' => 'Test3.png',
                'images' => json_encode(['Test1.png', 'Test1.jpg']),
                'description' => 'Test test hello this is test description3',
                'inclusions' => 'this inclusions3',
                'exclusions' => 'this exclusions3',
                'price' => 20000,
                'how_many_peoples' => 4,
                'hits' => 3,
                'status' => 'available',
                'departing' => Carbon::now()->format('Y-m-d'),
                'finishing' => Carbon::now()->addDays(5)->format('Y-m-d'),
            ],
            [
                'category_id' => 1,
                'travel_destination_id' => 2,
                'title' => 'TestPrivateTours4',
                'image' => 'Test4.png',
                'images' => json_encode(['Test1.png', 'Test1.jpg']),
                'description' => 'Test test hello this is test description4',
                'inclusions' => 'this inclusions4',
                'exclusions' => 'this exclusions4',
                'price' => 20000,
                'how_many_peoples' => 7,
                'hits' => 6,
                'status' => 'unavailable',
                'departing' => Carbon::now()->format('Y-m-d'),
                'finishing' => Carbon::now()->addDays(5)->format('Y-m-d'),
            ],
            [
                'category_id' => 2,
                'travel_destination_id' => 1,
                'title' => 'TestPrivateTours5',
                'image' => 'Test5.png',
                'images' => json_encode(['Test1.png', 'Test1.jpg']),
                'description' => 'Test test hello this is test description5',
                'inclusions' => 'this inclusions5',
                'exclusions' => 'this exclusions5',
                'price' => 20010,
                'how_many_peoples' => 7,
                'hits' => 6,
                'status' => 'unavailable',
                'departing' => Carbon::now()->format('Y-m-d'),
                'finishing' => Carbon::now()->addDays(5)->format('Y-m-d'),
            ],
            [
                'category_id' => 2,
                'travel_destination_id' => 3,
                'title' => 'TestPrivateTours6',
                'image' => 'Test6.png',
                'images' => json_encode(['Test1.png', 'Test1.jpg']),
                'description' => 'Test test hello this is test description6',
                'inclusions' => 'this inclusions6',
                'exclusions' => 'this exclusions6',
                'price' => 21000,
                'how_many_peoples' => 7,
                'hits' => 6,
                'status' => 'unavailable',
                'departing' => Carbon::now()->format('Y-m-d'),
                'finishing' => Carbon::now()->addDays(5)->format('Y-m-d'),
            ],
        ];

        foreach ($groupTours as $groupTour) {
            $this->createGroupTour($groupTour);
        }
    }

    public function createGroupTour(array $groupTour): void
    {
        GroupTour::create([
            'category_id' => $groupTour['category_id'],
            'travel_destination_id' => $groupTour['travel_destination_id'],
            'title' => $groupTour['title'],
            'image' => $groupTour['image'],
            'images' => $groupTour['images'],
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

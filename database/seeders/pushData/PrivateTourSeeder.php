<?php

namespace Database\Seeders\pushData;

use App\Models\Tours\PrivateTour;
use Illuminate\Database\Seeder;

class PrivateTourSeeder extends Seeder
{
    /**
     * Seed the categories table.
     *
     * @return void
     */
    public function run(): void
    {
        $privateTours = [
            [
                'category_id' => 1,
                'travel_destination_id' => 1,
                'title' => 'TestPrivateTours',
                'image' => 'Test.png',
                'description' => 'Private Test test hello this is test description',
                'inclusions' => 'this inclusions',
                'exclusions' => 'this exclusions',
                'hits' => 32,
                'departing' => now()->toDateString(),
                'finishing' => now()->addDays(5)->toDateString(),
            ],
            [
                'category_id' => 1,
                'travel_destination_id' => 2,
                'title' => 'TestPrivateTours2',
                'image' => 'Test2.png',
                'description' => 'Private Test test hello this is test description2',
                'inclusions' => 'this inclusions2',
                'exclusions' => 'this exclusions2',
                'hits' => 1,
                'departing' => now()->toDateString(),
                'finishing' => now()->addDays(5)->toDateString(),
            ],
        ];

        foreach ($privateTours as $privateTour) {
            $this->createPrivateTour($privateTour);
        }
    }

    public function createPrivateTour(array $privateTour): void
    {
        PrivateTour::create([
            'category_id' => $privateTour['category_id'],
            'travel_destination_id' => $privateTour['travel_destination_id'],
            'title' => $privateTour['title'],
            'image' => $privateTour['image'],
            'hits' => $privateTour['hits'],
            'description' => $privateTour['description'],
            'inclusions' => $privateTour['inclusions'],
            'exclusions' => $privateTour['exclusions'],
            'departing' => $privateTour['departing'],
            'finishing' => $privateTour['finishing'],
        ]);
    }
}

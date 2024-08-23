<?php

namespace Database\Seeders\pushData;

use App\Models\Itineraries\GroupTourItinerary;
use Illuminate\Database\Seeder;

class GroupTourItinerarySeeder extends Seeder
{
    /**
     * Seed the group_tour_itineraries table.
     *
     * @return void
     */
    public function run(): void
    {
        $itineraryGroupTours = [
            [
                'tour_id' => 1,
                'day_number' => 1,
                'title' => 'title 1 for 1',
                'description' => 'test description 1 for 1',
            ],
            [
                'tour_id' => 1,
                'day_number' => 2,
                'title' => 'title 2 for 1',
                'description' => 'test description 1 for 1',
            ],
            [
                'tour_id' => 1,
                'day_number' => 3,
                'title' => 'title 3 for 1',
                'description' => 'test description 1 for 1',
            ],
            [
                'tour_id' => 1,
                'day_number' => 4,
                'title' => 'title 4 for 1',
                'description' => 'test description 1 for 1',
            ],
            [
                'tour_id' => 2,
                'day_number' => 1,
                'title' => 'title 1 for 1',
                'description' => 'test description 1 for 1',
            ],
            [
                'tour_id' => 2,
                'day_number' => 2,
                'title' => 'title 2 for 1',
                'description' => 'test description 1 for 1',
            ],
            [
                'tour_id' => 2,
                'day_number' => 3,
                'title' => 'title 3 for 1',
                'description' => 'test description 1 for 1',
            ],
            [
                'tour_id' => 2,
                'day_number' => 4,
                'title' => 'title 4 for 1',
                'description' => 'test description 1 for 1',
            ],
        ];

        foreach ($itineraryGroupTours as $itineraryGroupTour) {
            $this->createItineraryGroupTour($itineraryGroupTour);
        }
    }

    /**
     * Создает запись в таблице group_tour_itineraries.
     *
     * @param array $itineraryGroupTour
     * @return void
     */
    public function createItineraryGroupTour(array $itineraryGroupTour): void
    {
        GroupTourItinerary::create([
            'tour_id' => $itineraryGroupTour['tour_id'],
            'day_number' => $itineraryGroupTour['day_number'],
            'title' => $itineraryGroupTour['title'],
            'description' => $itineraryGroupTour['description'],
        ]);
    }
}

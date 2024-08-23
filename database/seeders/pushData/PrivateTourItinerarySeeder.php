<?php

namespace Database\Seeders\pushData;

use App\Models\Itineraries\PrivateTourItinerary;
use Illuminate\Database\Seeder;

class PrivateTourItinerarySeeder extends Seeder
{
    /**
     * Seed the private_tour_itineraries table.
     *
     * @return void
     */
    public function run(): void
    {
        $itineraryPrivateTours = [
            [
                'tour_id' => 1,
                'day_number' => 1,
                'title' => 'Private tour title 1 for 1',
                'description' => 'Private tour description 1 for 1',
            ],
            [
                'tour_id' => 1,
                'day_number' => 2,
                'title' => 'Private tour title 2 for 1',
                'description' => 'Private tour description 2 for 1',
            ],
            [
                'tour_id' => 2,
                'day_number' => 1,
                'title' => 'Private tour title 1 for 2',
                'description' => 'Private tour description 1 for 2',
            ],
            [
                'tour_id' => 2,
                'day_number' => 2,
                'title' => 'Private tour title 2 for 2',
                'description' => 'Private tour description 2 for 2',
            ],
        ];

        foreach ($itineraryPrivateTours as $itineraryPrivateTour) {
            $this->createItineraryPrivateTour($itineraryPrivateTour);
        }
    }

    /**
     * Create a new record in the private_tour_itineraries table.
     *
     * @param array $itineraryPrivateTour
     * @return void
     */
    public function createItineraryPrivateTour(array $itineraryPrivateTour): void
    {
        PrivateTourItinerary::create([
            'tour_id' => $itineraryPrivateTour['tour_id'],
            'day_number' => $itineraryPrivateTour['day_number'],
            'title' => $itineraryPrivateTour['title'],
            'description' => $itineraryPrivateTour['description'],
        ]);
    }
}


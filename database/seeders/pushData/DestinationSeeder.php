<?php

namespace Database\Seeders\pushData;

use App\Models\Destination\Destination;
use App\Models\DestinationTranslation\DestinationTranslation;
use App\Models\Language\Language;
use Illuminate\Database\Seeder;

class DestinationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Создаем направления
        $destinations = [
            ['name' => 'Paris', 'image' => 'paris.jpg', 'description' => 'The city of light.'],
            ['name' => 'Tokyo', 'image' => 'tokyo.jpg', 'description' => 'A bustling metropolis.'],
            ['name' => 'New York', 'image' => 'newyork.jpg', 'description' => 'The Big Apple.'],
        ];

        foreach ($destinations as $destinationData) {
            $destination = Destination::create($destinationData);

            // Добавляем переводы для каждого направления
            foreach (Language::all() as $language) {
                $translatedName = $destinationData['name'] . ' (' . $language->name . ')';
                DestinationTranslation::create([
                    'destination_id' => $destination->id,
                    'language_id' => $language->id,
                    'translate_name' => $translatedName,
                ]);
            }
        }
    }
}

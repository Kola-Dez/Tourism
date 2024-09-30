<?php

namespace Database\Seeders\pushData;

use App\Models\Destination\Destination;
use App\Models\Language\Language;
use App\Models\TravelDestination\TravelDestination;
use App\Models\TravelDestinationTranslation\TravelDestinationTranslation;
use Illuminate\Database\Seeder;

class TravelDestinationSeeder extends Seeder
{
    /**
     * Заполнить таблицу travel_destinations данными.
     */
    public function run(): void
    {
        // Получаем все направления
        $destinations = Destination::all();

        // Проверяем, есть ли направления
        if ($destinations->isEmpty()) {
            return; // Выход, если нет направлений для создания travel destinations
        }

        // Пример данных для travel destinations
        $travelDestinations = [
            [
                'name' => 'Eiffel Tower Tour',
                'image' => 'eiffel_tower.jpg',
                'description' => 'Enjoy a guided tour of the Eiffel Tower.',
                'destination_id' => $destinations->first()->id, // Пример с первым направлением
            ],
            [
                'name' => 'Tokyo City Tour',
                'image' => 'tokyo_city.jpg',
                'description' => 'Experience the beauty of Tokyo on a guided tour.',
                'destination_id' => $destinations->where('name', 'Tokyo')->first()->id, // Получаем id по названию
            ],
            [
                'name' => 'Statue of Liberty Tour',
                'image' => 'statue_of_liberty.jpg',
                'description' => 'Visit the iconic Statue of Liberty in New York.',
                'destination_id' => $destinations->where('name', 'New York')->first()->id,
            ],
        ];

        // Заполняем таблицу travel_destinations
        foreach ($travelDestinations as $travelDestinationData) {
            $travelDestinations = TravelDestination::create($travelDestinationData);

            // Добавляем переводы для каждого направления
            foreach (Language::all() as $language) {
                $translatedName = $travelDestinationData['name'] . ' (' . $language->name . ')';
                TravelDestinationTranslation::create([
                    'travel_destination_id' => $travelDestinations->id,
                    'language_id' => $language->id,
                    'translate_name' => $translatedName,
                ]);
            }
        }
    }
}

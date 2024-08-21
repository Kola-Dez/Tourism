<?php

namespace Database\Seeders;

use App\Models\Destination\Destination;
use App\Models\TravelDestination\TravelDestination;
use Illuminate\Database\Seeder;

class TravelDestinationSeeder extends Seeder
{
    public function run(): void
    {
        $cities = [
            // Kyrgyzstan
            [
                'destination_id' => Destination::where('code', 'KG')->first()->id,
                'cities' => [
                    ['name' => 'Altyn Arashan', 'slug' => 'altyn arashan'],
                    ['name' => 'Arslanbob', 'slug' => 'arslanbob'],
                    ['name' => 'Batken', 'slug' => 'batken'],
                    ['name' => 'Bishkek', 'slug' => 'bishkek'],
                    ['name' => 'Burana Tower', 'slug' => 'burana tower'],
                    ['name' => 'Cholpon-Ata', 'slug' => 'cholpon ata'],
                    ['name' => 'Chon-Kemin', 'slug' => 'chon kemin'],
                    ['name' => 'Issyk-Kul', 'slug' => 'issyk kul'],
                    ['name' => 'Jalalabad', 'slug' => 'jalalabad'],
                    ['name' => 'Karakol', 'slug' => 'karakol'],
                ],
            ],
            // Kazakhstan
            [
                'destination_id' => Destination::where('code', 'KZ')->first()->id,
                'cities' => [
                    ['name' => 'Almaty', 'slug' => 'almaty'],
                    ['name' => 'Astana', 'slug' => 'astana'],
                    ['name' => 'Shymkent', 'slug' => 'shymkent'],
                    ['name' => 'Karaganda', 'slug' => 'karaganda'],
                    ['name' => 'Pavlodar', 'slug' => 'pavlodar'],
                    ['name' => 'Aktobe', 'slug' => 'aktobe'],
                    ['name' => 'Semey', 'slug' => 'semey'],
                    ['name' => 'Taraz', 'slug' => 'taraz'],
                ],
            ],
            // Uzbekistan
            [
                'destination_id' => Destination::where('code', 'UZ')->first()->id,
                'cities' => [
                    ['name' => 'Tashkent', 'slug' => 'tashkent'],
                    ['name' => 'Samarkand', 'slug' => 'samarkand'],
                    ['name' => 'Bukhara', 'slug' => 'bukhara'],
                    ['name' => 'Khiva', 'slug' => 'khiva'],
                    ['name' => 'Fergana', 'slug' => 'fergana'],
                    ['name' => 'Namangan', 'slug' => 'namangan'],
                    ['name' => 'Andijan', 'slug' => 'andijan'],
                    ['name' => 'Nukus', 'slug' => 'nukus'],
                ],
            ],
            // Tajikistan
            [
                'destination_id' => Destination::where('code', 'TJ')->first()->id,
                'cities' => [
                    ['name' => 'Dushanbe', 'slug' => 'dushanbe'],
                    ['name' => 'Khujand', 'slug' => 'khujand'],
                    ['name' => 'Kurgan-Tyube', 'slug' => 'kurgan tyube'],
                    ['name' => 'Istravshan', 'slug' => 'istravshan'],
                    ['name' => 'Garm', 'slug' => 'garm'],
                    ['name' => 'Panjakent', 'slug' => 'panjakent'],
                    ['name' => 'Kulob', 'slug' => 'kulob'],
                ],
            ],
            // Turkmenistan
            [
                'destination_id' => Destination::where('code', 'TM')->first()->id,
                'cities' => [
                    ['name' => 'Ashgabat', 'slug' => 'ashgabat'],
                    ['name' => 'Turkmenabat', 'slug' => 'turkmenabat'],
                    ['name' => 'Mary', 'slug' => 'mary'],
                    ['name' => 'Dashoguz', 'slug' => 'dashoguz'],
                    ['name' => 'Balkanabat', 'slug' => 'balkanabat'],
                    ['name' => 'Turbat', 'slug' => 'turbat'],
                ],
            ],
        ];

        foreach ($cities as $countryCities) {
            $this->createCities($countryCities['destination_id'], $countryCities['cities']);
        }
    }

    public function createCities(int $destinationId, array $cities): void
    {
        foreach ($cities as $city) {
            TravelDestination::create([
                'name' => $city['name'],
                'slug' => $city['slug'],
                'destination_id' => $destinationId,
            ]);
        }
    }
}

<?php

namespace Database\Seeders;

use App\Models\Destination\Destination;
use Illuminate\Database\Seeder;

class DestinationSeeder extends Seeder
{
    /**
     * Seed the countries table.
     *
     * @return void
     */
    public function run(): void
    {
        $countries = [
            [
                'code' => 'KG',
                'slug' => 'kyrgyzstan',
            ],
            [
                'code' => 'KZ',
                'slug' => 'kazakhstan',
            ],
            [
                'code' => 'UZ',
                'slug' => 'uzbekistan',
            ],
            [
                'code' => 'TJ',
                'slug' => 'tajikistan',
            ],
            [
                'code' => 'TM',
                'slug' => 'turkmenistan',
            ],
        ];

        foreach ($countries as $country) {
            $this->createCategory($country);
        }
    }

    public function createCategory(array $country): void
    {

        Destination::create([
            'code' => $country['code'],
            'slug' => $country['slug'],
        ]);
    }
}

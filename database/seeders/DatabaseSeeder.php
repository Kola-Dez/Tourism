<?php

namespace Database\Seeders;

use Database\Seeders\pushData\BlogSeeder;
use Database\Seeders\pushData\CategorySeeder;
use Database\Seeders\pushData\DestinationSeeder;
use Database\Seeders\pushData\GroupTourSeeder;
use Database\Seeders\pushData\LanguageSeeder;
use Database\Seeders\pushData\PrivateTourSeeder;
use Database\Seeders\pushData\TransportSeeder;
use Database\Seeders\pushData\TravelDestinationSeeder;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run(): void
    {
        $this->call([
            LanguageSeeder::class,
            DestinationSeeder::class,
            CategorySeeder::class,
            TravelDestinationSeeder::class,
            GroupTourSeeder::class,
            PrivateTourSeeder::class,
            TransportSeeder::class,
            BlogSeeder::class,
        ]);
    }
}

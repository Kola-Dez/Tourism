<?php

namespace Database\Seeders\pushData;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class TransportSeeder extends Seeder
{
    public function run(): void
    {
        $transports = [
            [
                'destination_id' => 1,
                'image' => 'image1.jpg',
                'direction' => 'North',
                'sedan' => 50.00,
                'van' => 70.00,
                'suv' => 80.00,
                'mini_van' => 90.00,
            ],
            [
                'destination_id' => 2,
                'image' => 'image2.jpg',
                'direction' => 'South',
                'sedan' => 60.00,
                'van' => 75.00,
                'suv' => 85.00,
                'mini_van' => 95.00,
            ],
        ];

        foreach ($transports as $transport) {
            DB::table('transports')->insert($transport);
        }
    }
}

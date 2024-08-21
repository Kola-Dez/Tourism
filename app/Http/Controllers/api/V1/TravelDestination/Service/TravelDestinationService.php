<?php

namespace App\Http\Controllers\api\V1\TravelDestination\Service;

use App\Models\TravelDestination\TravelDestination;

class TravelDestinationService
{
    public function getTravelBySlug(string $slug): TravelDestination
    {
        [$id] = explode('-', $slug);
        return TravelDestination::query()->findOrFail($id);
    }
    public function index(): array
    {
        return TravelDestination::all()->map(function ($travelDestination) {
            return [
                'name' => $travelDestination->translated_name,
                'slug' => $travelDestination->slug,
            ];
        })->toArray();
    }

    public function show(TravelDestination $travel): array
    {
        $travel->load('destination');
        return [
            'name' => $travel->translated_name,
            'image' => $travel->image,
            'description' => $travel->description,
            'destination' => $travel->destination->translated_code,
        ];
    }
}

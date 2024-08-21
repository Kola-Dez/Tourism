<?php

namespace App\Http\Controllers\api\V1\Destination\Service;

use App\Models\Destination\Destination;
use App\Models\TravelDestination\TravelDestination;

class DestinationService
{
    public function getCategoryBySlug(string $slug): Destination
    {
        [$id] = explode('-', $slug);
        return Destination::query()->findOrFail($id);
    }

    public function index(): array
    {
        return Destination::all()->map(function ($destination) {
            return [
                'nameTranslate' => $destination->translated_code,
                'slug' => $destination->slug,
                'image' => $destination->image,
                'description' => $destination->description,
            ];
        })->toArray();
    }


    public function show(Destination $destination): array
    {
        $data = [
            'nameTranslate' => $destination->translated_code,
            'slug' => $destination->slug,
            'image' => $destination->image,
            'description' => $destination->description,
        ];

        $data['travel_destinations'] = TravelDestination::all()->where('destination_id', $destination->id)->map(function ($travelDestination) {
            return [
                'name' => $travelDestination->translated_name,
                'slug' => $travelDestination->slug,
            ];
        })->toArray();

        return $data;
    }
}

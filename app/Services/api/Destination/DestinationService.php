<?php

namespace App\Services\api\Destination;

use App\Models\Destination\Destination;
use App\Models\Tours\GroupTour;
use App\Models\Tours\PrivateTour;
use App\Models\Transport\Transport;
use App\Models\TravelDestination\TravelDestination;
use App\Resources\api\Tours\GroupTourResource;
use App\Resources\api\Tours\PrivateTourResource;
use App\Resources\api\Transport\TransportResource;

class DestinationService
{
    public function getTravelDestinations(Destination $destination): array
    {
        return TravelDestination::where('destination_id', $destination->id)->get()->map(function ($travelDestination) {
            return [
                'slug' => $travelDestination->slug,
                'name' => $travelDestination->translated_name,
            ];
        })->toArray();
    }

    public function getGroupTours(Destination $destination): array
    {
        return TravelDestination::where('destination_id', $destination->id)->get()->flatMap(function ($travelDestination) {
            $groupTours = GroupTour::where('travel_destination_id', $travelDestination->id)->get();
            return GroupTourResource::collection($groupTours)->toArray(request());
        })->toArray();
    }


    public function getPrivateTours(Destination $destination): array
    {
        return TravelDestination::where('destination_id', $destination->id)->get()->flatMap(function ($travelDestination) {
            $privateTours = PrivateTour::where('travel_destination_id', $travelDestination->id)->get();
            return PrivateTourResource::collection($privateTours)->toArray(request());
        })->toArray();
    }

    public function getPopularTours(Destination $destination): array
    {
        $travelDestinations = TravelDestination::with(['groupTours', 'privateTours'])->get()->where('destination_id', $destination->id);

        return $this->getPopular($travelDestinations);
    }

    public function getPopular($tables): array
    {
        $allTours = collect();
        foreach ($tables as $table) {
            foreach (['groupTours', 'privateTours'] as $relation) {
                foreach ($table->$relation as $tour) {
                    $tour->table_name = $relation === 'groupTours' ? 'group_tours' : 'private_tours';
                    $allTours->push($tour);
                }
            }
        }

        $topTours = $allTours->sortByDesc('hits')->take(3);

        return $topTours->map(function ($tour) {
            return [
                'id' => $tour->id,
                'travel_destination' => $tour->travelDestination->translated_name,
                'destination' => $tour->travelDestination->Destination->translated_code,
                'description' => $tour->description,
                'date' => $tour->duration,
                'image' => $tour->image,
            ];
        })->values()->toArray();
    }

    public function getTransport(Destination $destination): array
    {
        $transport = Transport::where('destination_id', $destination->id)->get();

        return TransportResource::collection($transport)->toArray(request());
    }
}

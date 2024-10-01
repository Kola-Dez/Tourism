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
use App\Resources\api\TravelDestination\TravelDestinationResource;

class DestinationService
{
    public function getTravelDestinations(Destination $destination): array
    {
        $travelDestination = TravelDestination::where('destination_id', $destination->id)->get();

        return TravelDestinationResource::collection($travelDestination)->toArray(request());
    }

    public function getGroupTours(Destination $destination): array
    {
        $travelDestination = TravelDestination::where('destination_id', $destination->id)->get();

        $groupTours = GroupTour::whereIn('travel_destination_id', $travelDestination->pluck('id'))->get();

        return GroupTourResource::collection($groupTours)->toArray(request());
    }


    public function getPrivateTours(Destination $destination): array
    {
        $travelDestination = TravelDestination::where('destination_id', $destination->id)->get();

        $privateTours = PrivateTour::whereIn('travel_destination_id', $travelDestination->pluck('id'))->get();

        return PrivateTourResource::collection($privateTours)->toArray(request());
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

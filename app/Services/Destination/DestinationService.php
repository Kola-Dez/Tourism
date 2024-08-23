<?php

namespace App\Services\Destination;

use App\Models\Category\Category;
use App\Models\Destination\Destination;
use App\Models\Tours\GroupTour;
use App\Models\Tours\PrivateTour;
use App\Models\TravelDestination\TravelDestination;
use App\Resources\Tours\GroupTourResource;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Response;

class DestinationService
{
    public function getTravelDestinations(Destination $destination): array
    {
        return TravelDestination::where('destination_id', $destination->id)->get()->map(function ($travelDestination) {
            return [
                'id' => $travelDestination->id,
                'name' => $travelDestination->translated_name,
            ];
        })->toArray();
    }

    public function getGroupTours(Destination $destination): array
    {
        return TravelDestination::where('destination_id', $destination->id)->get()->flatMap(function ($travelDestination) {
            return GroupTour::where('travel_destination_id', $travelDestination->id)->get()->map(function ($groupTour) {
                return [
                    'id' => $groupTour->id,
                    'travel_destination' => $groupTour->travelDestination->translated_name,
                    'destination' => $groupTour->travelDestination->destination->translated_code,
                    'how_many_peoples' => $groupTour->how_many_peoples,
                    'price' => $groupTour->price,
                    'title' => $groupTour->title,
                    'image' => $groupTour->image,
                    'date' => $groupTour->duration,
                ];
            });
        })->toArray();
    }

    public function getPrivateTours(Destination $destination): array
    {
        return TravelDestination::where('destination_id', $destination->id)->get()->flatMap(function ($travelDestination) {
            return PrivateTour::where('travel_destination_id', $travelDestination->id)->get()->map(function ($privateTour) {
                return [
                    'id' => $privateTour->id,
                    'travel_destination' => $privateTour->travelDestination->translated_name,
                    'destination' => $privateTour->travelDestination->destination->translated_code,
                    'title' => $privateTour->title,
                    'image' => $privateTour->image,
                    'date' => $privateTour->duration,
                ];
            });
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
                'destination' => $tour->travelDestination->Destination->translated_code,
                'travel_destination' => $tour->travelDestination->translated_name,
                'description' => $tour->description,
                'date' => $tour->getDuration(),
                'image' => $tour->image,
            ];
        })->values()->toArray();
    }
}

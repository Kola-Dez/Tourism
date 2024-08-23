<?php

namespace App\Services\FindAdventure;

use App\Models\Category\Category;
use App\Models\Destination\Destination;
use App\Models\Tours\GroupTour;
use App\Models\Tours\PrivateTour;
use App\Models\TravelDestination\TravelDestination;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Response;

class FindAdventureService
{

    public function getCategoryBySlug(string $slug): Category
    {
        [$id] = explode('-', $slug);

        return Category::query()->findOrFail($id);
    }

    public function getDestinationBySlug(string $slug): Destination
    {
        [$id] = explode('-', $slug);

        return Destination::query()->findOrFail($id);
    }

    public function findAdventure($request): JsonResponse
    {
        $monthName = $request->input('month');
        $destination = $this->getDestinationBySlug($request->input('destination'));
        $category = $this->getCategoryBySlug($request->input('category'));

        if (!$monthName) {
            return Response::json([
                'status' => 400,
                'error' => 'missing_month',
                'message' => 'Month is required'
            ]);
        }

        if (!$destination->toArray()) {
            return Response::json([
                'status' => 404,
                'error' => 'destination_not_found',
                'message' => 'Destination not found'
            ]);
        }

        $monthNumber = date('m', strtotime($monthName));

        $tours['group_tours'] = $this->findGroupTours($destination, $category, $monthNumber);
        $tours['private_tours'] = $this->findPrivateTours($destination, $category, $monthNumber);

        return Response::json($tours,200,);
    }

    private function findGroupTours($destination, $category, $monthNumber)
    {
        return TravelDestination::where('destination_id', $destination->id)->get()
            ->flatMap(function ($travelDestination) use ($monthNumber, $category) {
                return GroupTour::where('travel_destination_id', $travelDestination->id)
                    ->whereMonth('departing', $monthNumber)
                    ->where('category_id', $category->id)
                    ->get()->map(function ($groupTour) {
                        return [
                            'id' => $groupTour->id,
                            'travel_destination' => $groupTour->travelDestination->translated_name,
                            'destination' => $groupTour->travelDestination->destination->translated_code,
                            'category' => $groupTour->category->translated_title,
                            'how_many_peoples' => $groupTour->how_many_peoples,
                            'price' => intval($groupTour->price),
                            'title' => $groupTour->title,
                            'image' => $groupTour->image,
                            'date' => $groupTour->duration,
                        ];
                    });
            });
    }

    private function findPrivateTours($destination, $category, $monthNumber)
    {
        return TravelDestination::where('destination_id', $destination->id)->get()
            ->flatMap(function ($travelDestination) use ($monthNumber, $category) {
                return PrivateTour::where('travel_destination_id', $travelDestination->id)
                    ->whereMonth('departing', $monthNumber)
                    ->where('category_id', $category->id)
                    ->get()->map(function ($privateTour) {
                        return [
                            'id' => $privateTour->id,
                            'travel_destination' => $privateTour->travelDestination->translated_name,
                            'destination' => $privateTour->travelDestination->destination->translated_code,
                            'category' => $privateTour->category->translated_title,
                            'title' => $privateTour->title,
                            'image' => $privateTour->image,
                            'date' => $privateTour->duration,
                        ];
                    });
            });
    }

}

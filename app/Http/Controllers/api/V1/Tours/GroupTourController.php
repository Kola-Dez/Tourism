<?php

namespace App\Http\Controllers\api\V1\Tours;

use App\Http\Controllers\Controller;
use App\Models\Itineraries\GroupTourItinerary;
use App\Models\Tours\GroupTour;
use App\Resources\Itinerary\ItineraryResource;
use App\Resources\Tours\GroupTourResource;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Response;

class GroupTourController extends Controller
{

    public function index(): JsonResponse
    {
        $groupTours = GroupTour::all();

        $groupTours = GroupTourResource::collection($groupTours)->toArray(request());

        return Response::json(['status' => 200,'success' => true, 'data' => $groupTours]);
    }

    public function show(GroupTour $groupTour): JsonResponse
    {
        $itinerary = GroupTourItinerary::where('tour_id', $groupTour->id)->get();

        $itinerary = ItineraryResource::collection($itinerary);

        $groupTour->hits += 1;
        $groupTour->save();

        $groupTour = GroupTourResource::make($groupTour);


        return Response::json(['status' => 200, 'success' => true, 'data' => $groupTour, 'itinerary' => $itinerary]);
    }

}

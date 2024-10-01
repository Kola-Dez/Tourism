<?php

namespace App\Http\Controllers\api\V1\Tours;

use App\Http\Controllers\Controller;
use App\Models\Itineraries\GroupTourItinerary;
use App\Models\Tours\GroupTour;
use App\Resources\api\Itinerary\ItineraryResource;
use App\Resources\api\Tours\GroupTourResource;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Response;

class GroupTourController extends Controller
{

    public function index(): JsonResponse
    {
        return Response::json([
            'status' => 200,
            'success' => true,
            'data' => GroupTourResource::collection(GroupTour::all())->toArray(request())
        ]);
    }

    public function show(GroupTour $groupTour): JsonResponse
    {
        $itinerary = GroupTourItinerary::where('tour_id', $groupTour->id)->get();

        $groupTour->hits += 1;
        $groupTour->save();

        return Response::json([
            'status' => 200,
            'success' => true,
            'data' => GroupTourResource::make($groupTour)->toArray(request()),
            'itinerary' => ItineraryResource::collection($itinerary)->toArray(request())
        ]);
    }

}

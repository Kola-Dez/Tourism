<?php

namespace App\Http\Controllers\api\V1\Tours;

use App\Http\Controllers\Controller;
use App\Models\Itineraries\GroupTourItinerary;
use App\Models\Tours\GroupTour;
use App\Resources\Itinerary\ItineraryResource;
use App\Resources\Tours\GroupTourResource;
use App\Services\Tours\GroupTourService;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Response;

class GroupTourController extends Controller
{
    private GroupTourService $service;

    public function __construct(GroupTourService $service)
    {
        $this->service = $service;
    }

    public function index(): JsonResponse
    {
        $groupTours = GroupTour::all();

        $groupTours = GroupTourResource::collection($groupTours)->toArray(request());

        return Response::json(['status' => 200,'success' => true, 'data' => $groupTours]);
    }

    public function show(GroupTour $groupTour): JsonResponse
    {
        $itinerary = GroupTourItinerary::all()->where('tour_id', $groupTour->id);

        $itinerary = ItineraryResource::collection($itinerary)->toArray(request());

        $groupTour = (new GroupTourResource($groupTour))->toArray(request());

        return Response::json(['status' => 200, 'success' => true, 'data' => $groupTour, 'itinerary' => $itinerary]);
    }

}

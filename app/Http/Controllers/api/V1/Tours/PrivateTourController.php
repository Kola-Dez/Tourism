<?php

namespace App\Http\Controllers\api\V1\Tours;

use App\Http\Controllers\Controller;
use App\Models\Itineraries\PrivateTourItinerary;
use App\Models\Tours\PrivateTour;
use App\Resources\api\Itinerary\ItineraryResource;
use App\Resources\api\Tours\PrivateTourResource;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Response;

class PrivateTourController extends Controller
{
    public function index(): JsonResponse
    {
        return Response::json([
            'status' => 200,
            'success' => true,
            'data' => PrivateTourResource::collection(PrivateTour::all())->toArray(request())
        ]);
    }

    public function show(PrivateTour $privateTour): JsonResponse
    {
        $itinerary = PrivateTourItinerary::all()->where('tour_id', $privateTour->id);

        $privateTour->hits += 1;
        $privateTour->save();

        return Response::json([
            'status' => 200,
            'success' => true,
            'data' => PrivateTourResource::make($privateTour)->toArray(request()),
            'itinerary' => ItineraryResource::collection($itinerary)->toArray(request())
        ]);
    }

}

<?php

namespace App\Http\Controllers\api\V1\Tours;

use App\Http\Controllers\Controller;
use App\Models\Itineraries\PrivateTourItinerary;
use App\Models\Tours\PrivateTour;
use App\Resources\Itinerary\ItineraryResource;
use App\Resources\Tours\PrivateTourResource;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Response;

class PrivateTourController extends Controller
{
    public function index(): JsonResponse
    {
        $privateTour = PrivateTour::all();

        if (!$privateTour) {
            return Response::json(status: 204);
        }

        $privateTour = PrivateTourResource::collection($privateTour)->toArray(request());

        return Response::json(['status' => 200,'success' => true, 'data' => $privateTour]);
    }

    public function show(PrivateTour $privateTour): JsonResponse
    {
        $itinerary = PrivateTourItinerary::all()->where('tour_id', $privateTour->id);

        $itinerary = ItineraryResource::collection($itinerary)->toArray(request());

        $privateTour->hits += 1;
        $privateTour->save();

        $privateTour = (new PrivateTourResource($privateTour))->toArray(request());

        return Response::json(['status' => 200, 'success' => true, 'data' => $privateTour, 'itinerary' => $itinerary]);
    }

}

<?php

namespace App\Http\Controllers\api\V1\TravelDestination;

use App\Http\Controllers\Controller;
use App\Models\TravelDestination\TravelDestination;
use App\Resources\TravelDestination\TravelDestinationResource;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Response;

class TravelDestinationController extends Controller
{

    public function index(): JsonResponse
    {
        $travelDestinations = TravelDestination::all();

        if (!$travelDestinations) {
            return Response::json(status: 204);
        }

        $travelDestinations = TravelDestinationResource::collection($travelDestinations)->toArray(request());

        return Response::json(['status' => 200, 'success' => true ,'data' => $travelDestinations]);
    }

    public function show(TravelDestination $travelDestination): JsonResponse
    {
        $travelDestination = TravelDestinationResource::make($travelDestination)->toArray(request());

        return Response::json(['status' => 200, 'success' => true ,'data' => $travelDestination]);
    }

}

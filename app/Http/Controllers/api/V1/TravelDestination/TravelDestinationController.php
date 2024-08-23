<?php

namespace App\Http\Controllers\api\V1\TravelDestination;

use App\Http\Controllers\Controller;
use App\Models\TravelDestination\TravelDestination;
use App\Resources\TravelDestination\TravelDestinationResource;
use App\Services\TravelDestination\TravelDestinationService;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Response;

class TravelDestinationController extends Controller
{
    private TravelDestinationService $service;

    public function __construct(TravelDestinationService $service)
    {
        $this->service = $service;
    }

    public function index(): JsonResponse
    {
        $travelDestinations = TravelDestination::all();

        $travelDestinations = TravelDestinationResource::collection($travelDestinations)->toArray(request());

        return Response::json(['status' => 200, 'success' => true ,'data' => $travelDestinations]);
    }

    public function show(TravelDestination $travelDestination): JsonResponse
    {
        $travelDestination = (new TravelDestinationResource($travelDestination))->toArray(request());

        return Response::json(['status' => 200, 'success' => true ,'data' => $travelDestination]);
    }

}

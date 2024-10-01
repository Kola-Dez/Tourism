<?php

namespace App\Http\Controllers\api\V1\TravelDestination;

use App\Http\Controllers\Controller;
use App\Models\TravelDestination\TravelDestination;
use App\Resources\api\TravelDestination\TravelDestinationResource;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Response;

class TravelDestinationController extends Controller
{

    public function index(): JsonResponse
    {
        return Response::json([
            'status' => 200,
            'success' => true ,
            'data' => TravelDestinationResource::collection(TravelDestination::all())->toArray(request())
        ]);
    }

    public function show(TravelDestination $travelDestination): JsonResponse
    {
        return Response::json([
            'status' => 200,
            'success' => true,
            'data' => TravelDestinationResource::make($travelDestination)->toArray(request())
        ]);
    }

}

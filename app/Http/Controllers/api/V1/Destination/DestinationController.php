<?php

namespace App\Http\Controllers\api\V1\Destination;

use App\Http\Controllers\Controller;
use App\Models\Destination\Destination;
use App\Resources\api\Destination\DestinationResource;
use App\Services\api\Destination\DestinationService;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Response;

class DestinationController extends Controller
{
    private DestinationService $service;
    public function __construct(DestinationService $service)
    {
        $this->service = $service;
    }

    public function index(): JsonResponse
    {
        return response()->json([
            'status' => 200,
            'success' => true,
            'data' => DestinationResource::collection(Destination::all())->toArray(request())
        ]);
    }

    public function show(Destination $destination): JsonResponse
    {
        return response()->json([
            'status' => 200,
            'success' => true,
            'data' => DestinationResource::make($destination)->toArray(request())
        ]);
    }

    public function travelDestinations(Destination $destination): JsonResponse
    {
        return response()->json([
            'status' => 200,
            'success' => true,
            'data' => $this->service->getTravelDestinations($destination)
        ]);
    }

    public function groupTours(Destination $destination): JsonResponse
    {
        return response()->json([
            'status' => 200,
            'success' => true,
            'data' => $this->service->getGroupTours($destination)
        ]);
    }

    public function privateTours(Destination $destination): JsonResponse
    {
        return response()->json([
            'status' => 200,
            'success' => true,
            'data' => $this->service->getPrivateTours($destination)
        ]);
    }

    public function popularTours(Destination $destination): JsonResponse
    {
        return response()->json([
            'status' => 200,
            'success' => true,
            'data' => $this->service->getPopularTours($destination)
        ]);
    }

    public function transportShow(Destination $destination): JsonResponse
    {
        return response()->json([
            'status' => 200,
            'success' => true,
            'data' => $this->service->getTransport($destination)
        ]);
    }

}

<?php

namespace App\Http\Controllers\api\V1\Destination;

use App\Http\Controllers\Controller;
use App\Models\Destination\Destination;
use App\Resources\Destination\DestinationResource;
use App\Services\Destination\DestinationService;
use Illuminate\Http\JsonResponse;

class DestinationController extends Controller
{
    private DestinationService $service;
    public function __construct(DestinationService $service)
    {
        $this->service = $service;
    }

    public function index(): JsonResponse
    {
        $destinations = Destination::all();

        $destinations =  DestinationResource::collection($destinations);

        return response()->json(['status' => 200, 'success' => true, 'data' => $destinations]);
    }

    public function show(Destination $destination): JsonResponse
    {
        $destination = (new DestinationResource($destination));

        return response()->json(['status' => 200, 'success' => true, 'data' => $destination]);
    }

    public function travelDestinations(Destination $destination): JsonResponse
    {
        $data = $this->service->getTravelDestinations($destination);

        return response()->json(['status' => 200, 'success' => true, 'data' => $data]);
    }

    public function groupTours(Destination $destination): JsonResponse
    {
        $data = $this->service->getGroupTours($destination);

        return response()->json(['status' => 200, 'success' => true, 'data' => $data]);
    }

    public function privateTours(Destination $destination): JsonResponse
    {
        $data = $this->service->getPrivateTours($destination);

        return response()->json(['status' => 200, 'success' => true, 'data' => $data]);
    }

    public function popularTours(Destination $destination): JsonResponse
    {
        $data = $this->service->getPopularTours($destination);

        return response()->json(['status' => 200, 'success' => true, 'data' => $data]);
    }
}

<?php

namespace App\Http\Controllers\api\V1\Destination;

use App\Http\Controllers\Controller;
use App\Models\Destination\Destination;
use App\Resources\Destination\DestinationResource;
use App\Services\Destination\DestinationService;
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
        $destinations = Destination::all();

        if (!$destinations) {
            return Response::json(status: 204);
        }

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

        if (!$data) {
            return Response::json(status: 204);
        }

        return response()->json(['status' => 200, 'success' => true, 'data' => $data]);
    }

    public function groupTours(Destination $destination): JsonResponse
    {
        $data = $this->service->getGroupTours($destination);

        if (!$data) {
            return Response::json(status: 204);
        }

        return response()->json(['status' => 200, 'success' => true, 'data' => $data]);
    }

    public function privateTours(Destination $destination): JsonResponse
    {
        $data = $this->service->getPrivateTours($destination);

        if (!$data) {
            return Response::json(status: 204);
        }

        return response()->json(['status' => 200, 'success' => true, 'data' => $data]);
    }

    public function popularTours(Destination $destination): JsonResponse
    {
        $data = $this->service->getPopularTours($destination);

        if (!$data) {
            return Response::json(status: 204);
        }

        return response()->json(['status' => 200, 'success' => true, 'data' => $data]);
    }

    public function transportShow(Destination $destination): JsonResponse
    {
        $data = $this->service->getTransport($destination);

        if (!$data) {
            return Response::json(status: 204);
        }

        return response()->json(['status' => 200, 'success' => true, 'data' => $data]);
    }

}

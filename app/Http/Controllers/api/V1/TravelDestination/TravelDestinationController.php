<?php

namespace App\Http\Controllers\api\V1\TravelDestination;

use App\Http\Controllers\api\V1\TravelDestination\Service\TravelDestinationService;
use App\Http\Controllers\Controller;
use Illuminate\Http\JsonResponse;

class TravelDestinationController extends Controller
{
    private TravelDestinationService $service;

    public function __construct(TravelDestinationService $service)
    {
        $this->service = $service;
    }

    public function index(): JsonResponse
    {
        $travel = $this->service->index();

        return response()->json(['status' => 200, 'success' => true ,'data' => $travel]);
    }

    public function show(string $slug): JsonResponse
    {
        $travel = $this->service->getTravelBySlug($slug);

        $data = $this->service->show($travel);

        return response()->json(['status' => 200, 'success' => true ,'data' => $data]);
    }
}

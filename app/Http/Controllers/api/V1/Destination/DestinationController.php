<?php

namespace App\Http\Controllers\api\V1\Destination;

use App\Http\Controllers\api\V1\Destination\Service\DestinationService;
use App\Http\Controllers\Controller;
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
        $destinations = $this->service->index();

        return response()->json(['status' => 200, 'success' => true, 'data' => $destinations]);
    }

    public function show(string $slug): JsonResponse
    {
        $destination = $this->service->getCategoryBySlug($slug);

        $data = $this->service->show($destination);

        return response()->json(['status' => 200, 'success' => true, 'data' => $data]);
    }
}

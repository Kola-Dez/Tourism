<?php

namespace App\Http\Controllers\api\V1\FindAdventure;

use App\Http\Controllers\Controller;
use App\Services\api\FindAdventure\FindAdventureService;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Response;

class FindAdventureController extends Controller
{
    private FindAdventureService $service;
    public function __construct(FindAdventureService $service)
    {
        $this->service = $service;
    }

    public function findAdventure(): JsonResponse
    {
        return Response::json([
            'status' => 200,
            'success' => true,
            'data' => $this->service->findAdventure(request())
        ]);
    }
}

<?php

namespace App\Http\Controllers\api\V1\FindAdventure;

use App\Http\Controllers\Controller;
use App\Services\FindAdventure\FindAdventureService;
use Illuminate\Http\JsonResponse;

class FindAdventureController extends Controller
{
    private FindAdventureService $service;
    public function __construct(FindAdventureService $service)
    {
        $this->service = $service;
    }

    public function findAdventure(): JsonResponse
    {
        return $this->service->findAdventure(request());
    }
}

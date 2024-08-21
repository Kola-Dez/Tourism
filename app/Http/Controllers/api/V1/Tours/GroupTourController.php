<?php

namespace App\Http\Controllers\api\V1\Tours;

use App\Http\Controllers\api\V1\Tours\Services\GroupTourService;
use App\Http\Controllers\Controller;
use App\Models\Tours\GroupTour;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Response;

class GroupTourController extends Controller
{
    private GroupTourService $service;

    public function __construct(GroupTourService $service)
    {
        $this->service = $service;
    }

    public function show($id): JsonResponse
    {
        $tour = $this->service->show($id);

        return Response::json(['status' => 200, 'success' => true, 'data' => $tour]);
    }
}

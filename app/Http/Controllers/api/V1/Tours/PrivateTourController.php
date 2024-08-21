<?php

namespace App\Http\Controllers\api\V1\Tours;

use App\Http\Controllers\api\V1\Tours\Services\PrivateTourService;
use App\Http\Controllers\Controller;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Response;

class PrivateTourController extends Controller
{
    private PrivateTourService $service;

    public function __construct(PrivateTourService $service)
    {
        $this->service = $service;
    }

    public function show($id): JsonResponse
    {
        $tour = $this->service->show($id);

        return Response::json(['status' => 200, 'success' => true, 'data' => $tour]);
    }

}

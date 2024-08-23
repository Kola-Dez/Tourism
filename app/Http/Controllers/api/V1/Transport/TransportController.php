<?php

namespace App\Http\Controllers\api\V1\Transport;

use App\Http\Controllers\Controller;
use App\Models\Transport\Transport;
use App\Resources\Transport\TransportResource;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Response;

class TransportController extends Controller
{
    public function index(): JsonResponse
    {
        $transports = Transport::all();

        $transports = TransportResource::collection($transports);

        return Response::json(['status' => 200, 'success' => true, 'data' => $transports]);
    }

    public function show(Transport $transport): JsonResponse
    {
        $transport = (new TransportResource($transport))->toArray(request());

        return Response::json(['status' => 200, 'success' => true, 'data' => $transport]);
    }
}

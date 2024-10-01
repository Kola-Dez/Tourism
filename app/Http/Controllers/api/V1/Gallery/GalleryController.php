<?php

namespace App\Http\Controllers\api\V1\Gallery;

use App\Http\Controllers\Controller;
use App\Models\Gallery\Gallery;
use App\Resources\api\Gallery\GalleryResource;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Response;

class GalleryController extends Controller
{
    public function index(): JsonResponse
    {
        return Response::json([
            'status' => 200,
            'success' => true,
            'data' => GalleryResource::collection(Gallery::all())->toArray(request())
        ]);
    }
}

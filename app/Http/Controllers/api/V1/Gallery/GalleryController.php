<?php

namespace App\Http\Controllers\api\V1\Gallery;

use App\Http\Controllers\Controller;
use App\Models\Gallery\Gallery;
use App\Resources\Gallery\GalleryResource;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Response;

class GalleryController extends Controller
{
    public function index(): JsonResponse
    {
        $galleries = Gallery::all();

        if (!$galleries->toArray()) {
            return Response::json(status: 204);
        }

        $galleries = GalleryResource::collection($galleries);

        return Response::json(['status' => 200, 'success' => true, 'data' => $galleries]);
    }
}

<?php

namespace App\Http\Controllers\api\V1\Blog;

use App\Http\Controllers\Controller;
use App\Models\Blog\Blog;
use App\Resources\api\Blog\BlogResource;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Response;

class BlogController extends Controller
{
    public function index(): JsonResponse
    {
        $bogs = Blog::all();

        if (!$bogs) {
            return Response::json(status: 204);
        }

        $bogs = BlogResource::collection($bogs)->toArray(request());

        return Response::json(['status' => 200, 'success' => true, 'data' => $bogs]);
    }

    public function show(Blog $blog): JsonResponse
    {
        $blog = BlogResource::make($blog);

        return Response::json(['status' => 200, 'success' => true, 'data' => $blog]);
    }
}

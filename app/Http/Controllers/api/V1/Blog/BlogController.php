<?php

namespace App\Http\Controllers\api\V1\Blog;

use App\Http\Controllers\Controller;
use App\Models\Blog\Blog;
use App\Resources\Blog\BlogResource;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Response;

class BlogController extends Controller
{
    public function index(): JsonResponse
    {
        $bogs = Blog::all();

        $bogs = BlogResource::collection($bogs);

        return Response::json(['status' => 200, 'success' => true, 'data' => $bogs]);
    }

    public function show(Blog $blog): JsonResponse
    {
        $blog = (new BlogResource($blog))->toArray(request());

        return Response::json(['status' => 200, 'success' => true, 'data' => $blog]);
    }
}

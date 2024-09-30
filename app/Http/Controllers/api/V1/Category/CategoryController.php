<?php

namespace App\Http\Controllers\api\V1\Category;

use App\Http\Controllers\Controller;
use App\Models\Category\Category;
use App\Resources\api\Category\CategoryResource;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Response;

class CategoryController extends Controller
{

    public function index(): JsonResponse
    {
        return Response::json([
            'status' => 200,
            'success' => true,
            'data' => CategoryResource::collection(Category::all())->toArray(request())
        ]);
    }

    public function show(Category $category): JsonResponse
    {
        return Response::json([
            'status' => 200,
            'success' => true,
            'data' => CategoryResource::make($category)->toArray(request())
        ]);
    }
}

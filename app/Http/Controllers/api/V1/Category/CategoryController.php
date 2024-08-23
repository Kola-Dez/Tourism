<?php

namespace App\Http\Controllers\api\V1\Category;

use App\Http\Controllers\Controller;
use App\Models\Category\Category;
use App\Resources\Category\CategoryResource;
use App\Services\Category\CategoryService;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Response;

class CategoryController extends Controller
{
    private CategoryService $service;

    public function __construct(CategoryService $service)
    {
        $this->service = $service;
    }

    public function index(): JsonResponse
    {
        $categories = Category::all();

        $categories = CategoryResource::collection($categories)->toArray(request());

        return Response::json(['status' => 200, 'success' => true, 'data' => $categories]);
    }

    public function show(Category $category): JsonResponse
    {
        $category = (new CategoryResource($category))->toArray(request());

        return Response::json(['status' => 200, 'success' => true, 'data' => $category]);
    }
}

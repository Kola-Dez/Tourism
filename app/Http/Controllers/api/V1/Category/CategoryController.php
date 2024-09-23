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
        $categories = Category::all();

        if (!$categories) {
            return Response::json(status: 204);
        }

        $categories = CategoryResource::collection($categories)->toArray(request());

        return Response::json(['status' => 200, 'success' => true, 'data' => $categories]);
    }

    public function show(Category $category): JsonResponse
    {
        $category = CategoryResource::make($category)->toArray(request());

        return Response::json(['status' => 200, 'success' => true, 'data' => $category]);
    }

}

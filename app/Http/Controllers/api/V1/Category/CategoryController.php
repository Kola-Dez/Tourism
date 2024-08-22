<?php

namespace App\Http\Controllers\api\V1\Category;

use App\Http\Controllers\api\V1\Category\Services\CategoryService;
use App\Http\Controllers\Controller;
use App\Models\Category\Category;
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
        $categories = $this->service->nested();

        return Response::json(['status' => 200, 'success' => true, 'data' => $categories]);
    }

    public function mostPopularTours(): JsonResponse
    {
        $popular = $this->service->getPopular();

        return Response::json(['status' => 200, 'success' => true, 'data' => $popular]);
    }


    public function show(Category $slug): JsonResponse // TODO: Route model binding
    {
        $category = $this->service->getCategoryBySlug($slug);

        $data = $this->service->show($category);

        return Response::json(['status' => 200, 'success' => true, 'data' => $data]);
    }

}

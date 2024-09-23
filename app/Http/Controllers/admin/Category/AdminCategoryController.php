<?php

namespace App\Http\Controllers\admin\Category;

use App\Http\Controllers\Controller;
use App\Http\Requests\Category\StoreRequest;
use App\Http\Requests\Category\UpdateRequest;
use App\Models\Category\Category;
use App\Resources\admin\Category\AdminCategoryResource;
use App\Services\admin\Category\AdminCategoryService;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Foundation\Application;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class AdminCategoryController extends Controller
{
    private AdminCategoryService $service;

    public function __construct(AdminCategoryService $service) {
        $this->service = $service;
    }

    public function index(Request $request): Factory|View|Application
    {
        $categories = Category::all();

        $categories = AdminCategoryResource::collection($categories)->toArray($request);

        return view('admin.category.index', compact('categories'));
    }

    public function show(Category $category): View|Factory|Application
    {
        $category = AdminCategoryResource::make($category)->toArray(request());

        return view('admin.category.show.show', compact('category'));
    }

    public function create(): View|Factory|Application
    {
        return view('admin.category.create.create');
    }

    public function store(StoreRequest $request): RedirectResponse
    {
        $this->service->store($request);

        return redirect()->route('admin.categories.index');
    }

    public function edit(Category $category): View|Factory|Application
    {
        $category = AdminCategoryResource::make($category)->toArray(request());

        return view('admin.category.edit.edit', compact('category'));
    }

    public function update(UpdateRequest $request, $id): RedirectResponse
    {
        $data = $request->all();

        $this->service->edit($data, $id);

        return redirect()->route('admin.categories.index');
    }

    public function destroy(Category $category): RedirectResponse
    {
        $this->service->destroy($category);

        return redirect()->route('admin.categories.index');
    }
}

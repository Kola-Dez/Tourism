<?php

namespace App\Http\Controllers\admin\CategoryLanguage;

use App\Http\Controllers\Controller;
use App\Http\Requests\CategoryLanguage\StoreRequest;
use App\Http\Requests\CategoryLanguage\UpdateRequest;
use App\Models\Category\Category;
use App\Models\CategoryTranslation\CategoryTranslation;
use App\Models\Language\Language;
use App\Resources\admin\Category\AdminCategoryResource;
use App\Resources\admin\CategoryLanguage\AdminCategoryLanguageResource;
use App\Resources\admin\Language\AdminLanguageResource;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Foundation\Application;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Routing\Redirector;

class AdminCategoryLanguageController extends Controller
{

    public function index(): Factory|View|Application
    {
        $categoryLanguages = AdminCategoryLanguageResource::collection(CategoryTranslation::all())->toArray(request());

        return view('admin.categoryLanguage.index', compact('categoryLanguages'));
    }

    public function show($id): View|Factory|Application
    {
        $categoryLanguage = CategoryTranslation::find($id);

        $categoryLanguage = AdminCategoryLanguageResource::make($categoryLanguage)->toArray(request());

        return view('admin.categoryLanguage.show.show', compact('categoryLanguage'));
    }

    public function create(): Factory|View|Application
    {
        $data['categories'] = AdminCategoryResource::collection(Category::all())->toArray(request());
        $data['languages'] = AdminLanguageResource::collection(Language::all())->toArray(request());

        return view('admin.categoryLanguage.create.create', compact('data'));
    }

    public function store(StoreRequest $request): Application|Redirector|RedirectResponse
    {
        $validatedData = $request->validated();

        CategoryTranslation::updateOrCreate(
            [
                'category_id' => $validatedData['category_id'],
                'language_id' => $validatedData['language_id']
            ],
            [
                'translate_title' => $validatedData['translate_title'],
                'translate_description' => $validatedData['translate_description']
            ]
        );

        return redirect()->route('admin.category_languages.index');
    }

    public function edit($id): View|Factory|Application
    {
        $categoryLanguage = CategoryTranslation::find($id);

        $data['categoryTranslation'] = AdminCategoryLanguageResource::make($categoryLanguage)->toArray(request());
        $data['categories'] = AdminCategoryResource::collection(Category::all())->toArray(request());
        $data['languages'] = AdminLanguageResource::collection(Language::all())->toArray(request());

        return view('admin.categoryLanguage.edit.edit', compact('data'));
    }

    public function update(UpdateRequest $request, $id): RedirectResponse
    {
        $data = $request->all();
        $categoryLanguage = CategoryTranslation::find($id);

        $categoryLanguage->update($data);

        return redirect()->route('admin.category_languages.index');
    }

    public function destroy($id): Application|JsonResponse|Redirector|RedirectResponse
    {
        $categoryLanguage = CategoryTranslation::find($id);

        $categoryLanguage->delete();

        return redirect(route('admin.category_languages.index'));
    }

}

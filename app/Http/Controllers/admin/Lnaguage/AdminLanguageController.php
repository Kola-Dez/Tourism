<?php

namespace App\Http\Controllers\admin\Lnaguage;

use App\Http\Controllers\Controller;
use App\Http\Requests\Language\StoreRequest;
use App\Http\Requests\Language\UpdateRequest;
use App\Models\Language\Language;
use App\Resources\admin\Language\AdminLanguageResource;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Foundation\Application;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Routing\Redirector;

class AdminLanguageController extends Controller
{
    public function index(): Factory|View|Application
    {
        $languages = AdminLanguageResource::collection(Language::all())->toArray(request());

        return view('admin.language.index', compact('languages'));
    }

    public function create(): Factory|View|Application
    {
        return view('admin.language.create.create');
    }

    public function store(StoreRequest $request): Application|Redirector|RedirectResponse
    {
        Language::create($request->validated());

        return redirect()->route('admin.languages.index');
    }

    public function edit(Language $language): View|Factory|Application
    {
        $language = AdminLanguageResource::make($language)->toArray(request());

        return view('admin.language.edit.edit', compact('language'));
    }

    public function update(UpdateRequest $request, $id): RedirectResponse
    {
        $data = $request->all();

        $destination = Language::findOrFail($id);

        $destination->update($data);

        return redirect()->route('admin.languages.index');
    }

    public function destroy($id): Application|JsonResponse|Redirector|RedirectResponse
    {
        $language = Language::find($id);

        $language->delete();

        return redirect(route('admin.languages.index'));
    }
}

<?php

namespace App\Http\Controllers\admin\DestinationLanguage;

use App\Http\Controllers\Controller;
use App\Http\Requests\DestinationLanguage\StoreRequest;
use App\Http\Requests\DestinationLanguage\UpdateRequest;
use App\Models\Destination\Destination;
use App\Models\DestinationTranslation\DestinationTranslation;
use App\Models\Language\Language;
use App\Resources\admin\Destination\AdminDestinationResource;
use App\Resources\admin\DestinationLanguage\AdminDestinationLanguageResource;
use App\Resources\admin\Language\AdminLanguageResource;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Foundation\Application;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Routing\Redirector;

class AdminDestinationLanguageController extends Controller
{

    public function index(): Factory|View|Application
    {
        $destinationsLanguages = AdminDestinationLanguageResource::collection(DestinationTranslation::all())->toArray(request());

        return view('admin.destinationLanguage.index', compact('destinationsLanguages'));
    }

    public function show($id): View|Factory|Application
    {
        $destinationTranslation = DestinationTranslation::find($id);

        $destinationTranslation = AdminDestinationLanguageResource::make($destinationTranslation)->toArray(request());

        return view('admin.destinationLanguage.show.show', compact('destinationTranslation'));
    }

    public function create(): Factory|View|Application
    {
        $data['destinations'] = AdminDestinationResource::collection(Destination::all())->toArray(request());
        $data['languages'] = AdminLanguageResource::collection(Language::all())->toArray(request());

        return view('admin.destinationLanguage.create.create', compact('data'));
    }

    public function store(StoreRequest $request): Application|Redirector|RedirectResponse
    {
        $validatedData = $request->validated();

        DestinationTranslation::updateOrCreate(
            [
                'destination_id' => $validatedData['destination_id'],
                'language_id' => $validatedData['language_id']
            ],
            [
                'translate_name' => $validatedData['translate_name'],
                'translate_description' => $validatedData['translate_description']
            ]
        );

        return redirect()->route('admin.destination_languages.index');
    }

    public function edit($id): View|Factory|Application
    {
        $destinationTranslation = DestinationTranslation::find($id);

        $data['destinationTranslation'] = AdminDestinationLanguageResource::make($destinationTranslation)->toArray(request());
        $data['destinations'] = AdminDestinationResource::collection(Destination::all())->toArray(request());
        $data['languages'] = AdminLanguageResource::collection(Language::all())->toArray(request());

        return view('admin.destinationLanguage.edit.edit', compact('data'));
    }

    public function update(UpdateRequest $request, $id): RedirectResponse
    {
        $data = $request->all();
        $destinationTranslate = DestinationTranslation::find($id);

        $destinationTranslate->update($data);

        return redirect()->route('admin.destination_languages.index');
    }

    public function destroy($id): Application|JsonResponse|Redirector|RedirectResponse
    {
        $destinationTranslation = DestinationTranslation::find($id);

        $destinationTranslation->delete();

        return redirect(route('admin.destination_languages.index'));
    }

}

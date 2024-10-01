<?php

namespace App\Http\Controllers\admin\TravelDestinationLanguage;

use App\Http\Controllers\Controller;
use App\Http\Requests\TravelDestinationLanguage\StoreRequest;
use App\Http\Requests\TravelDestinationLanguage\UpdateRequest;
use App\Models\Language\Language;
use App\Models\TravelDestination\TravelDestination;
use App\Models\TravelDestinationTranslation\TravelDestinationTranslation;
use App\Resources\admin\DestinationLanguage\AdminDestinationLanguageResource;
use App\Resources\admin\Language\AdminLanguageResource;
use App\Resources\admin\TravelDestination\AdminTravelDestinationResources;
use App\Resources\admin\TravelDestinationLanguage\AdminTravelDestinationLanguageResource;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Foundation\Application;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Routing\Redirector;

class AdminTravelDestinationLanguageController extends Controller
{

    public function index(): Factory|View|Application
    {
        $travelDestinationsLanguages = AdminTravelDestinationLanguageResource::collection(TravelDestinationTranslation::all())->toArray(request());

        return view('admin.travelDestinationLanguage.index', compact('travelDestinationsLanguages'));
    }

    public function show($id): View|Factory|Application
    {
        $travelDestinationsLanguage = TravelDestinationTranslation::find($id);

        $travelDestinationsLanguage = AdminTravelDestinationLanguageResource::make($travelDestinationsLanguage)->toArray(request());

        return view('admin.travelDestinationLanguage.show.show', compact('travelDestinationsLanguage'));
    }

    public function create(): Factory|View|Application
    {
        $data['travelDestinations'] = AdminTravelDestinationResources::collection(TravelDestination::all())->toArray(request());
        $data['languages'] = AdminLanguageResource::collection(Language::all())->toArray(request());

        return view('admin.travelDestinationLanguage.create.create', compact('data'));
    }

    public function store(StoreRequest $request): Application|Redirector|RedirectResponse
    {
        $validatedData = $request->validated();

        TravelDestinationTranslation::updateOrCreate(
            [
                'travel_destination_id' => $validatedData['travel_destination_id'],
                'language_id' => $validatedData['language_id']
            ],
            [
                'translate_name' => $validatedData['translate_name'],
                'translate_description' => $validatedData['translate_description']
            ]
        );

        return redirect()->route('admin.travel_destination_languages.index');
    }

    public function edit($id): View|Factory|Application
    {
        $travelDestinationTranslation = TravelDestinationTranslation::find($id);

        $data['travelDestinationTranslation'] = AdminTravelDestinationLanguageResource::make($travelDestinationTranslation)->toArray(request());
        $data['travel_destinations'] = AdminTravelDestinationResources::collection(TravelDestination::all())->toArray(request());
        $data['languages'] = AdminLanguageResource::collection(Language::all())->toArray(request());

        return view('admin.travelDestinationLanguage.edit.edit', compact('data'));
    }

    public function update(UpdateRequest $request, $id): RedirectResponse
    {
        $data = $request->all();
        $destinationTranslate = TravelDestinationTranslation::find($id);

        $destinationTranslate->update($data);

        return redirect()->route('admin.travel_destination_languages.index');
    }

    public function destroy($id): Application|JsonResponse|Redirector|RedirectResponse
    {
        $travelDestinationsLanguage = TravelDestinationTranslation::find($id);

        $travelDestinationsLanguage->delete();

        return redirect(route('admin.travel_destination_languages.index'));
    }

}

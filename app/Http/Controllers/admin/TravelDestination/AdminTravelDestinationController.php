<?php

namespace App\Http\Controllers\admin\TravelDestination;

use App\Http\Controllers\Controller;
use App\Http\Requests\TravelDestination\StoreRequest;
use App\Http\Requests\TravelDestination\UpdateRequest;
use App\Models\Destination\Destination;
use App\Models\TravelDestination\TravelDestination;
use App\Resources\admin\Destination\AdminDestinationResource;
use App\Resources\admin\TravelDestination\AdminTravelDestinationResources;
use App\Services\admin\TravelDestination\AdminTravelDestinationService;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Foundation\Application;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Routing\Redirector;

class AdminTravelDestinationController extends Controller
{
    private AdminTravelDestinationService $service;

    public function __construct(AdminTravelDestinationService $service) {
        $this->service = $service;
    }

    public function index(Request $request): Factory|View|Application
    {
        $travelDestinations = $this->service->index($request);

        $data['travelDestinations'] = AdminTravelDestinationResources::collection($travelDestinations)->toArray($request);

        $data['destinations'] = AdminDestinationResource::collection(Destination::all())->toArray($request);

        return view('admin.travelDestination.index', compact('data'));
    }

    public function create(): Factory|View|Application
    {
        $data['destinations'] = AdminDestinationResource::collection(Destination::all())->toArray(request());

        return view('admin.travelDestination.create.create', compact('data'));
    }

    public function store(StoreRequest $request): Application|Redirector|RedirectResponse
    {
        $this->service->store($request);

        return redirect()->route('admin.travel_destinations.index');
    }

    public function show(TravelDestination $travelDestination): View|Factory|Application
    {
        $travelDestination = AdminTravelDestinationResources::make($travelDestination)->toArray(request());

        return view('admin.travelDestination.show.show', compact('travelDestination'));
    }

    public function edit(TravelDestination $travelDestination): View|Factory|Application
    {
        $data['travelDestination'] = AdminTravelDestinationResources::make($travelDestination)->toArray(request());
        $data['destinations'] = AdminDestinationResource::collection(Destination::all())->toArray(request());

        return view('admin.travelDestination.edit.edit', compact('data'));
    }

    public function update(UpdateRequest $request, $id): RedirectResponse
    {
        $data = $request->all();

        $this->service->edit($data, $id);

        return redirect()->route('admin.travel_destinations.index');
    }

    public function destroy($id): Application|JsonResponse|Redirector|RedirectResponse
    {
        $tour = TravelDestination::find($id);

        $this->service->delete($tour);

        return redirect(route('admin.travel_destinations.index'));
    }
}

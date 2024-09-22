<?php

namespace App\Http\Controllers\admin\Tours\Tours;

use App\Http\Controllers\admin\Tours\Service\AdminPrivateTourService;
use App\Http\Controllers\Controller;
use App\Http\Requests\Tour\Private\StoreRequest;
use App\Http\Requests\Tour\Private\UpdateRequest;
use App\Models\Category\Category;
use App\Models\Destination\Destination;
use App\Models\Itineraries\PrivateTourItinerary;
use App\Models\Tours\PrivateTour;
use App\Resources\admin\Category\AdminCategoryResource;
use App\Resources\admin\Destination\AdminDestinationResource;
use App\Resources\admin\Itinerary\AdminItineraryResource;
use App\Resources\admin\Tours\AdminPrivateTourResource;
use App\Resources\Itinerary\ItineraryResource;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Routing\Redirector;
use Illuminate\Support\Facades\Response;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Foundation\Application;

class AdminPrivateTourController extends Controller
{
    private AdminPrivateTourService $service;

    public function __construct(AdminPrivateTourService $service)
    {
        $this->service = $service;
    }

    public function index(Request $request): Factory|View|Application
    {
        $tours = $this->service->index($request);

        $tours = AdminPrivateTourResource::collection($tours)->toArray($request);

        return view('admin.tours.private.index', compact('tours'));
    }

    public function show(PrivateTour $privateTour): View|Factory|Application
    {
        $itinerary = PrivateTourItinerary::where('tour_id', $privateTour->id)->get();

        $privateTour = AdminPrivateTourResource::make($privateTour)->toArray(request());

        $privateTour['itineraries'] = ItineraryResource::collection($itinerary)->toArray(request());;

        return view('admin.tours.private.show.show', compact('privateTour'));
    }

    public function create(): Factory|View|Application
    {
        $data['destinations'] = AdminDestinationResource::collection(Destination::all())->toArray(request());
        $data['categories'] = AdminCategoryResource::collection(Category::all())->toArray(request());

        return view('admin.tours.private.create.create', compact('data'));
    }

    public function store(StoreRequest $request): Application|Redirector|RedirectResponse
    {
        $this->service->store($request);

        return redirect()->route('admin.private_tours.index');
    }

    public function edit(PrivateTour $privateTour): View|Factory|Application
    {
        $data['privateTour'] = AdminPrivateTourResource::make($privateTour)->toArray(request());
        $data['destinations'] = AdminDestinationResource::collection(Destination::all())->toArray(request());
        $data['categories'] = AdminCategoryResource::collection(Category::all())->toArray(request());
        $data['itineraries'] = AdminItineraryResource::collection(PrivateTourItinerary::where('tour_id', $privateTour->id)->get())->toArray(request());

        return view('admin.tours.private.edit.edit', compact('data'));
    }

    public function update(UpdateRequest $request, $id): RedirectResponse
    {
        $data = $request->all();

        $this->service->edit($data, $id);

        return redirect()->route('admin.private_tours.index');
    }

    public function destroy($id): Application|JsonResponse|Redirector|RedirectResponse
    {
        $tour = PrivateTour::find($id);

        if (!$tour) {
            return Response::json(['status' => 404, 'success' => false, 'message' => 'tour not found.'], 404);
        }

        $this->service->delete($tour);

        return redirect(route('admin.private_tours.index'));
    }
}

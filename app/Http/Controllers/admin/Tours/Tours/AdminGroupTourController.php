<?php

namespace App\Http\Controllers\admin\Tours\Tours;

use App\Http\Controllers\admin\Tours\Service\AdminGroupTourService;
use App\Http\Controllers\Controller;
use App\Http\Requests\Tour\Group\StoreRequest;
use App\Http\Requests\Tour\Group\UpdateRequest;
use App\Models\Category\Category;
use App\Models\Destination\Destination;
use App\Models\Itineraries\GroupTourItinerary;
use App\Models\Tours\GroupTour;
use App\Resources\admin\Category\AdminCategoryResource;
use App\Resources\admin\Destination\AdminDestinationResource;
use App\Resources\admin\Itinerary\AdminItineraryResource;
use App\Resources\admin\Tours\AdminGroupTourResource;
use App\Resources\Itinerary\ItineraryResource;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Foundation\Application;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Routing\Redirector;
use Illuminate\Support\Facades\Response;

class AdminGroupTourController extends Controller
{
    private AdminGroupTourService $service;

    public function __construct(AdminGroupTourService $service)
    {
        $this->service = $service;
    }


    public function index(Request $request): Factory|View|Application
    {
        $tours = $this->service->index($request);

        $tours = AdminGroupTourResource::collection($tours)->toArray($request);

        return view('admin.tours.group.index', compact('tours'));
    }

    public function create(): Factory|View|Application
    {
        $data['destinations'] = AdminDestinationResource::collection(Destination::all())->toArray(request());
        $data['categories'] = AdminCategoryResource::collection(Category::all())->toArray(request());

        return view('admin.tours.group.create.create', compact('data'));
    }

    public function store(StoreRequest $request): Application|Redirector|RedirectResponse
    {
        $this->service->store($request);

        return redirect()->route('admin.group_tours.index');
    }

    public function show(GroupTour $groupTour): View|Factory|Application
    {
        $itinerary = GroupTourItinerary::where('tour_id', $groupTour->id)->get();

        $groupTour = AdminGroupTourResource::make($groupTour)->toArray(request());

        $groupTour['itineraries'] = ItineraryResource::collection($itinerary)->toArray(request());;

        return view('admin.tours.group.show.show', compact('groupTour'));
    }

    public function edit(GroupTour $groupTour): View|Factory|Application
    {
        $data['groupTour'] = AdminGroupTourResource::make($groupTour)->toArray(request());
        $data['destinations'] = AdminDestinationResource::collection(Destination::all())->toArray(request());
        $data['categories'] = AdminCategoryResource::collection(Category::all())->toArray(request());
        $data['itineraries'] = AdminItineraryResource::collection(GroupTourItinerary::where('tour_id', $groupTour->id)->get())->toArray(request());

        return view('admin.tours.group.edit.edit', compact('data'));
    }

    public function update(UpdateRequest $request, $id): RedirectResponse
    {
        $data = $request->all();

        $this->service->edit($data, $id);

        return redirect()->route('admin.group_tours.index');
    }

    public function destroy($id): Application|JsonResponse|Redirector|RedirectResponse
    {
        $tour = GroupTour::find($id);

        if (!$tour) {
            return Response::json(['status' => 404, 'success' => false, 'message' => 'tour not found.'], 404);
        }

        $this->service->delete($tour);

        return redirect(route('admin.group_tours.index'));
    }
}

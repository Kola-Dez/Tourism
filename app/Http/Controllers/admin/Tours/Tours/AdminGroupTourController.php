<?php

namespace App\Http\Controllers\admin\Tours\Tours;

use App\Http\Controllers\admin\Tours\Service\AdminGroupTourService;
use App\Http\Controllers\Controller;
use App\Http\Requests\Tour\Group\StoreRequest;
use App\Http\Requests\Tour\Group\UpdateRequest;
use App\Models\Tours\GroupTour;
use App\Resources\admin\Tours\AdminGroupTourResource;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Foundation\Application;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
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
        $destinations = $this->service->create();

        return view('admin.tours.group.create.create', compact('destinations'));
    }

    public function store(Request $request)
    {
        dd($request);

    }


    public function show(GroupTour $groupTour): JsonResponse
    {
        $tour = $this->service->show($groupTour);

        return Response::json($tour);
    }


    public function update(UpdateRequest $request, $id): JsonResponse
    {
        $data = $request->all();

        $tour = $this->service->edit($data, $id);

        return Response::json($tour);
    }

    public function destroy($id): JsonResponse
    {
        $tour = GroupTour::find($id);

        if (!$tour) {
            return Response::json(['status' => 404, 'success' => false, 'message' => 'tour not found.'], 404);
        }

        $this->service->delete($tour);

        return Response::json(['status' => 204, 'success' => true]);
    }
}

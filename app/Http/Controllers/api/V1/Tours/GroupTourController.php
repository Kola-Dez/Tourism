<?php

namespace App\Http\Controllers\api\V1\Tours;

use App\Http\Controllers\api\V1\Tours\Services\Group\GroupTourService;
use App\Http\Controllers\Controller;
use App\Http\Requests\Tour\Group\StoreRequest;
use App\Http\Requests\Tour\Group\UpdateRequest;
use App\Models\Tours\GroupTour;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Response;

class GroupTourController extends Controller
{
    private GroupTourService $service;

    public function __construct(GroupTourService $service)
    {
        $this->service = $service;
    }

    public function index(): JsonResponse
    {
        $tours = GroupTour::all();

        return Response::json($tours);
    }

    public function show($id): JsonResponse
    {
        $tour = $this->service->show($id);

        return Response::json($tour);
    }

    public function store(StoreRequest $request): JsonResponse
    {
        $data = $request->all();

        $tour = $this->service->create($data);

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

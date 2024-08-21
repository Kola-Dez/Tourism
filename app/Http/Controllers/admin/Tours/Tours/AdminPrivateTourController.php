<?php

namespace App\Http\Controllers\admin\Tours\Tours;

use App\Http\Controllers\admin\Tours\Service\AdminPrivateTourService;
use App\Http\Controllers\Controller;
use App\Http\Requests\Tour\Private\StoreRequest;
use App\Http\Requests\Tour\Private\UpdateRequest;
use App\Models\Tours\PrivateTour;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Response;

class AdminPrivateTourController extends Controller
{
    private AdminPrivateTourService $service;

    public function __construct(AdminPrivateTourService $service)
    {
        $this->service = $service;
    }

    public function index(): JsonResponse
    {
        $tours = PrivateTour::all();

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
        $tour = PrivateTour::find($id);

        if (!$tour) {
            return Response::json(['status' => 404, 'success' => false, 'message' => 'tour not found.'], 404);
        }

        $this->service->delete($tour);

        return Response::json(['status' => 204, 'success' => true]);
    }
}

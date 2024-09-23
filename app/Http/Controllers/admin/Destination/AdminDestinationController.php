<?php

namespace App\Http\Controllers\admin\Destination;

use App\Http\Controllers\Controller;
use App\Http\Requests\Destination\UpdateRequest;
use App\Models\Destination\Destination;
use App\Resources\admin\Destination\AdminDestinationResource;
use App\Services\admin\Destination\AdminDestinationService;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Foundation\Application;
use Illuminate\Http\RedirectResponse;

class AdminDestinationController extends Controller
{
    private AdminDestinationService $service;

    public function __construct(AdminDestinationService $service) {
        $this->service = $service;
    }

    public function index(): Factory|View|Application
    {
        $destinations = AdminDestinationResource::collection(Destination::all())->toArray(request());

        return view('admin.destination.index', compact('destinations'));
    }

    public function show(Destination $destination): View|Factory|Application
    {
        $destination = AdminDestinationResource::make($destination)->toArray(request());

        return view('admin.destination.show.show', compact('destination'));
    }

    public function edit(Destination $destination): View|Factory|Application
    {
        $destination = AdminDestinationResource::make($destination)->toArray(request());

        return view('admin.destination.edit.edit', compact('destination'));
    }

    public function update(UpdateRequest $request, $id): RedirectResponse
    {
        $data = $request->all();

        $this->service->edit($data, $id);

        return redirect()->route('admin.destinations.index');
    }

}

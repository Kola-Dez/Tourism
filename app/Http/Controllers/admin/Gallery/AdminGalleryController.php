<?php

namespace App\Http\Controllers\admin\Gallery;

use App\Http\Controllers\Controller;
use App\Http\Requests\Gallery\StoreRequest;
use App\Models\Gallery\Gallery;
use App\Resources\admin\Gallery\AdminGalleryResource;
use App\Services\admin\Gallery\AdminGalleryService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Contracts\View\View;
use Illuminate\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Routing\Redirector;

class AdminGalleryController extends Controller
{
    private AdminGalleryService $service;
    public function __construct(AdminGalleryService $service)
    {
        $this->service = $service;
    }

    public function index(Request $request): View|Factory|Application
    {
        $data = AdminGalleryResource::collection(Gallery::all())->toArray($request);

        return view('admin.gallery.index', compact('data'));
    }

    public function show(Gallery $gallery): View|Factory|Application
    {
        $gallery = AdminGalleryResource::make($gallery)->toArray(request());

        return view('admin.gallery.show.show', compact('gallery'));
    }

    public function create(): Factory|View|Application
    {
        return view('admin.gallery.create.create');
    }

    public function store(StoreRequest $request): Application|Redirector|RedirectResponse
    {
        $this->service->store($request);

        return redirect()->route('admin.galleries.index');
    }

    public function destroy($id): Application|JsonResponse|Redirector|RedirectResponse
    {
        $blog = Gallery::find($id);

        $this->service->delete($blog);

        return redirect(route('admin.galleries.index'));
    }
}

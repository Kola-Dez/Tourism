<?php

namespace App\Http\Controllers\admin\blog;

use App\Http\Controllers\Controller;
use App\Http\Requests\Blog\StoreRequest;
use App\Http\Requests\Blog\UpdateRequest;
use App\Models\Blog\Blog;
use App\Models\Destination\Destination;
use App\Resources\admin\Blog\AdminBlogResource;
use App\Resources\admin\Destination\AdminDestinationResource;
use App\Services\admin\Blog\AdminBlogService;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Foundation\Application;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Routing\Redirector;

class AdminBlogController extends Controller
{
    private AdminBlogService $service;

    public function __construct(AdminBlogService $service)
    {
        $this->service = $service;
    }

    public function index(Request $request): View|Factory|Application
    {
        $blogs = $this->service->index($request);

        $data['blogs'] = AdminBlogResource::collection($blogs)->toArray($request);

        $data['destinations'] = AdminDestinationResource::collection(Destination::all())->toArray($request);

        return view('admin.blog.index', compact('data'));
    }

    public function show(Blog $blog): View|Factory|Application
    {
        $blog = AdminBlogResource::make($blog)->toArray(request());

        return view('admin.blog.show.show', compact('blog'));
    }

    public function create(): Factory|View|Application
    {
        $data['destinations'] = AdminDestinationResource::collection(Destination::all())->toArray(request());

        return view('admin.blog.create.create', compact('data'));
    }

    public function store(StoreRequest $request): Application|Redirector|RedirectResponse
    {
        $this->service->store($request);

        return redirect()->route('admin.blogs.index');
    }

    public function edit(Blog $blog): View|Factory|Application
    {
        $data['blog'] = AdminBlogResource::make($blog)->toArray(request());
        $data['destinations'] = AdminDestinationResource::collection(Destination::all())->toArray(request());

        return view('admin.blog.edit.edit', compact('data'));
    }

    public function update(UpdateRequest $request, $id): RedirectResponse
    {
        $data = $request->all();

        $this->service->edit($data, $id);

        return redirect()->route('admin.blogs.index');
    }

    public function destroy($id): Application|JsonResponse|Redirector|RedirectResponse
    {
        $blog = Blog::find($id);

        $this->service->delete($blog);

        return redirect(route('admin.blogs.index'));
    }
}

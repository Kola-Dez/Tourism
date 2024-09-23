<?php

namespace App\Services\admin\Blog;

use App\Http\Requests\Blog\StoreRequest;
use App\Models\Blog\Blog;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Storage;

class AdminBlogService
{
    public function index($request): Collection
    {
        $search = $request->input('table_search', '');

        $query = Blog::query()
            ->with(['destination']) // Загружаем связанную модель 'destination'
            ->when($search, function ($query, $search) {
                $query->where('title', 'like', "%{$search}%")
                    ->orWhereHas('destination', function ($q) use ($search) {
                        $q->where('code', 'like', "%{$search}%"); // Поиск по полю 'code' в связанном 'destination'
                    });
            });

        return $query->get(); // Возвращаем результат
    }

    public function store(StoreRequest $request): void
    {
        $data = $request->validated();

        // Обработка одиночного изображения
        if ($request->hasFile('image')) {
            $file = $request->file('image');
            $filePath = $file->store('images/blogs', 'public');
            $data['image'] = '/storage/' . $filePath;
        }
        Blog::create($data);
    }

    public function edit(array $data, $id): void
    {
        $blog = Blog::findOrFail($id);

        $oldImagePath = $blog->image;

        // Обработка одиночного изображения
        if (isset($data['image']) && $data['image'] instanceof UploadedFile) {
            $image = $data['image'];
            $imagePath = $image->store('images/blogs', 'public');
            $data['image'] = Storage::url($imagePath);

            if ($oldImagePath) {
                $oldImagePath = str_replace('/storage/', 'public/', $blog->image);
                if (Storage::exists($oldImagePath)) {
                    Storage::delete($oldImagePath);
                }
            }
        } else {
            $data['image'] = $blog->image;
        }

        $blog->update($data);
    }

    public function delete($blog): void
    {
        if ($blog->image) {
            $imagePath = str_replace('/storage/', '', $blog->image);

            if (Storage::disk('public')->exists($imagePath)) {
                Storage::disk('public')->delete($imagePath);
            }
        }

        $blog->delete();
    }
}

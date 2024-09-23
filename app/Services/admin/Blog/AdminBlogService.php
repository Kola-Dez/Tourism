<?php

namespace App\Services\admin\Blog;

use App\Http\Requests\Blog\StoreRequest;
use App\Models\Blog\Blog;
use Illuminate\Support\Facades\Storage;

class AdminBlogService
{

    public function store(StoreRequest $request): void
    {
        $data = $request->validated();

        // Обработка одиночного изображения
        if ($request->hasFile('image')) {
            $file = $request->file('image');
            $filePath = $file->store('images/blogs', 'public');
            $data['image'] = '/storage/' . $filePath;
        }
        // Создание записи о туре
        Blog::create($data);
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

<?php

namespace App\Services\admin\Category;

use App\Http\Requests\Category\StoreRequest;
use App\Models\Category\Category;
use Dflydev\DotAccessData\Data;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;

class AdminCategoryService
{
    public function store(StoreRequest $request): void
    {
        $data = $request->validated();

        if ($request->hasFile('image')) {
            $file = $request->file('image');
            $filePath = $file->store('images/category', 'public');
            $data['image'] = '/storage/' . $filePath;
        }
        Category::create($data);
    }

    public function edit(array $data, $id): void
    {
        $category = Category::findOrFail($id);

        $oldImagePath = $category->image;

        // Обработка одиночного изображения
        if (isset($data['image']) && $data['image'] instanceof UploadedFile) {
            $image = $data['image'];
            $imagePath = $image->store('images/category', 'public');
            $data['image'] = Storage::url($imagePath);

            if ($oldImagePath) {
                $oldImagePath = str_replace('/storage/', 'public/', $category->image);
                if (Storage::exists($oldImagePath)) {
                    Storage::delete($oldImagePath);
                }
            }
        } else {
            $data['image'] = $category->image;
        }

        $category->update($data);
    }

    public function destroy($category): void
    {
        if ($category->image) {
            $imagePath = str_replace('/storage/', '', $category->image);

            if (Storage::disk('public')->exists($imagePath)) {
                Storage::disk('public')->delete($imagePath);
            }
        }
        $category->delete();
    }
}

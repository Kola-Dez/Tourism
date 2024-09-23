<?php

namespace App\Services\admin\Gallery;

use App\Http\Requests\Gallery\StoreRequest;
use App\Models\Gallery\Gallery;
use Illuminate\Support\Facades\Storage;

class AdminGalleryService
{
    public function store(StoreRequest $request): void
    {
        $data = $request->validated();

        // Обработка одиночного изображения
        if ($request->hasFile('image')) {
            $file = $request->file('image');
            $filePath = $file->store('images/galleries', 'public');
            $data['image'] = '/storage/' . $filePath;
        }

        Gallery::create($data);
    }

    public function delete($gallery): void
    {
        if ($gallery->image) {
            $imagePath = str_replace('/storage/', '', $gallery->image);

            if (Storage::disk('public')->exists($imagePath)) {
                Storage::disk('public')->delete($imagePath);
            }
        }

        $gallery->delete();
    }
}

<?php

namespace App\Services\admin\Destination;

use App\Http\Requests\Destination\StoreRequest;
use App\Models\Destination\Destination;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;

class AdminDestinationService
{
    public function edit(array $data, $id): void
    {
        $destination = Destination::findOrFail($id);

        $oldImagePath = $destination->image;

        // Обработка одиночного изображения
        if (isset($data['image']) && $data['image'] instanceof UploadedFile) {
            $image = $data['image'];
            $imagePath = $image->store('images/destinations', 'public');
            $data['image'] = Storage::url($imagePath);

            if ($oldImagePath) {
                $oldImagePath = str_replace('/storage/', 'public/', $destination->image);
                if (Storage::exists($oldImagePath)) {
                    Storage::delete($oldImagePath);
                }
            }
        } else {
            $data['image'] = $destination->image;
        }

        $destination->update($data);
    }

    public function store(StoreRequest $request): void
    {
        $data = $request->validated();

        if ($request->hasFile('image')) {
            $file = $request->file('image');
            $filePath = $file->store('images/destinations', 'public');
            $data['image'] = '/storage/' . $filePath;
        }

        Destination::create($data);
    }

    public function delete($destination): void
    {
        // Удаление главного изображения
        if ($destination->image) {
            $imagePath = str_replace('/storage/', '', $destination->image);

            if (Storage::disk('public')->exists($imagePath)) {
                Storage::disk('public')->delete($imagePath);
            }
        }

        // Удаление записи о туре
        $destination->delete();
    }
}

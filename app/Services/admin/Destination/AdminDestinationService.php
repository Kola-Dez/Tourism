<?php

namespace App\Services\admin\Destination;

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
            $imagePath = $image->store('images/destination', 'public');
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

}

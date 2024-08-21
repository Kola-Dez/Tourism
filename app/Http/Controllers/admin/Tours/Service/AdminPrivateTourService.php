<?php

namespace App\Http\Controllers\admin\Tours\Service;

use Illuminate\Support\Facades\Storage;
use Illuminate\Http\UploadedFile;
use App\Models\Tours\PrivateTour;
use Carbon\Carbon;

class AdminPrivateTourService
{
    public function create(array $data): array
    {
        if (isset($data['image']) && $data['image'] instanceof UploadedFile) {
            $imagePath = $data['image']->store('images', 'public');
            $data['image'] = Storage::url($imagePath);
        }

        $tour = PrivateTour::create($data);

        return $tour->toArray();
    }

    public function edit(array $data, $id): array
    {
        $tour = PrivateTour::findOrFail($id);

        if (isset($data['image']) && $data['image'] instanceof UploadedFile) {
            $image = $data['image'];
            $imagePath = $image->store('images/', 'public');
            $data['image'] = Storage::url($imagePath);

            $oldImagePath = $tour->image;
            if ($oldImagePath) {
                $oldImagePath = str_replace('storage/', 'public/', $tour->image);
                if (Storage::exists($oldImagePath)) {
                    Storage::delete($oldImagePath);
                }
            }
        }else{
            $data['image'] = $tour->image;
        }

        $tour->update($data);

        return $tour->toArray();
    }

    public function delete($tour): void
    {
        if ($tour->image) {
            $imagePath = str_replace('storage/', 'public/', $tour->image);
            if (Storage::exists($imagePath)) {
                Storage::delete($imagePath);
            }
        }
        $tour->delete();
    }

    public function show($id): array
    {
        $tour = PrivateTour::findOrFail($id);

        return [
            'category' => __('messages.categories.' . $tour->category->title),
            'price' => intval($tour->price),
        ];
    }
}

<?php

namespace App\Http\Controllers\api\V1\Tours\Services\Private;

use App\Models\api\V1\Tours\PrivateTour;
use Carbon\Carbon;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;

class PrivateTourService
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

        $tour->hits++;
        $tour->save();

        $startDate = Carbon::parse($tour->start_date);
        $endDate = Carbon::parse($tour->end_date);
        $duration = intval($startDate->diffInDays($endDate));

        return [
            'category' => __('messages.categories.' . $tour->category->title),
            'price' => intval($tour->price),
            'date' => $duration . 'D/' . $duration -1 . 'N',
        ];
    }
}

<?php

namespace App\Http\Controllers\api\V1\Tours\Services\Group;

use App\Models\Tours\GroupTour;
use Carbon\Carbon;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;

class GroupTourService
{
    public function create(array $data): array
    {
        if (isset($data['image']) && $data['image'] instanceof UploadedFile) {
            $imagePath = $data['image']->store('images', 'public');
            $data['image'] = Storage::url($imagePath);
        }

        $tour = GroupTour::create($data);

        return $tour->toArray();
    }

    public function edit(array $data, $id): array
    {
        $tour = GroupTour::findOrFail($id);

        $oldImagePath = $tour->image;

        if (isset($data['image']) && $data['image'] instanceof UploadedFile) {
            $image = $data['image'];
            $imagePath = $image->store('images/', 'public');
            $data['image'] = Storage::url($imagePath);

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
        $tour = GroupTour::findOrFail($id);

        $tour->hits++;
        $tour->save();

        $startDate = Carbon::parse($tour->departing);
        $endDate = Carbon::parse($tour->finishing);
        $duration = intval($startDate->diffInDays($endDate));

        return [
            'category' => __('messages.categories.' . $tour->category->title),
            'peoples' => $tour->how_many_peoples,
            'price' => intval($tour->price),
            'date' => $duration . 'D/' . $duration -1 . 'N',
        ];
    }
}

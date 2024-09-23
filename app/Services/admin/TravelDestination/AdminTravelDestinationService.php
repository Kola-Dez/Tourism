<?php

namespace App\Services\admin\TravelDestination;

use App\Http\Requests\TravelDestination\StoreRequest;
use App\Models\TravelDestination\TravelDestination;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;

class AdminTravelDestinationService
{
    public function index($request): Collection
    {
        $search = $request->input('table_search', '');

        $query = TravelDestination::query()
            ->with(['destination'])
            ->when($search, function ($query, $search) {
                $query->where('name', 'like', "%{$search}%")
                    ->orWhereHas('destination', function ($q) use ($search) {
                        $q->where('code', 'like', "%{$search}%");
                    })
                    ->orWhereHas('destination', function ($q) use ($search) {
                        $q->where('slug', 'like', "%{$search}%");
                    });
            });

        return $query->get();
    }
    public function store(StoreRequest $request): void
    {
        $data = $request->validated();

        // Обработка одиночного изображения
        if ($request->hasFile('image')) {
            $file = $request->file('image');
            $filePath = $file->store('images/travelDestinations', 'public');
            $data['image'] = '/storage/' . $filePath;
        }

        $travelDestination = TravelDestination::create($data);

        $travelDestination->slug = $travelDestination->name;
        $travelDestination->save();
    }

    public function edit(array $data, $id): void
    {
        $travelDestination = TravelDestination::findOrFail($id);

        $oldImagePath = $travelDestination->image;

        // Обработка одиночного изображения
        if (isset($data['image']) && $data['image'] instanceof UploadedFile) {
            $image = $data['image'];
            $imagePath = $image->store('images/travelDestinations', 'public');
            $data['image'] = Storage::url($imagePath);

            if ($oldImagePath) {
                $oldImagePath = str_replace('/storage/', 'public/', $travelDestination->image);
                if (Storage::exists($oldImagePath)) {
                    Storage::delete($oldImagePath);
                }
            }
        } else {
            $data['image'] = $travelDestination->image;
        }

        $travelDestination['slug'] = $travelDestination['name'];

        $travelDestination->update($data);
    }


    public function delete($travelDestination): void
    {
        // Удаление главного изображения
        if ($travelDestination->image) {
            $imagePath = str_replace('/storage/', '', $travelDestination->image);

            if (Storage::disk('public')->exists($imagePath)) {
                Storage::disk('public')->delete($imagePath);
            }
        }

        // Удаление записи о туре
        $travelDestination->delete();
    }
}

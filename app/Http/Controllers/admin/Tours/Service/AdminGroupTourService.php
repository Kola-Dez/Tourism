<?php

namespace App\Http\Controllers\admin\Tours\Service;

use App\Http\Requests\Tour\Group\StoreRequest;
use App\Models\Category\Category;
use App\Models\Destination\Destination;
use App\Models\Tours\GroupTour;
use App\Models\TravelDestination\TravelDestination;
use App\Resources\admin\Destination\AdminDestinationResource;
use App\Resources\Category\CategoryResource;
use App\Resources\Destination\DestinationResource;
use App\Resources\TravelDestination\TravelDestinationResource;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;

class AdminGroupTourService
{
    public function index($request): Collection
    {
        $search = $request->input('table_search', '');
        $departingDate = $request->input('departing_date', '');

        $query = GroupTour::query()
            ->with(['travelDestination.destination', 'category'])
            ->when($search, function ($query, $search) {
                $query->where('title', 'like', "%{$search}%")
                    ->orWhereHas('travelDestination.destination', function ($q) use ($search) {
                        $q->where('code', 'like', "%{$search}%");
                    })
                    ->orWhereHas('travelDestination', function ($q) use ($search) {
                        $q->where('name', 'like', "%{$search}%");
                    })
                    ->orWhereHas('category', function ($q) use ($search) {
                        $q->where('title', 'like', "%{$search}%");
                    })
                    ->orWhere('price', 'like', "%{$search}%")
                    ->orWhere('description', 'like', "%{$search}%");
            })
            ->when($departingDate, function ($query, $departingDate) {
                $query->whereDate('departing', $departingDate);
            });

        return $query->get();
    }

    public function show($id): array
    {
        $tour = GroupTour::findOrFail($id);

        return [
            'category' => __('messages.categories.' . $tour->category->title),
            'peoples' => $tour->how_many_peoples,
            'price' => intval($tour->price),

        ];
    }

    public function store(StoreRequest $request): void
    {
        $data = $request->validated();

        if ($request->hasFile('image')) {
            $file = $request->file('image');
            $filePath = $file->store('images/tours', 'public');
            $data['image'] = $filePath;
        }

        // Преобразуйте дату и время в формат MySQL
        $data['departing'] = date('Y-m-d H:i:s', strtotime($data['departing']));
        $data['finishing'] = date('Y-m-d H:i:s', strtotime($data['finishing']));

        // Создайте запись в базе данных
       GroupTour::create($data);
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
}

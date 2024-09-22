<?php

namespace App\Http\Controllers\admin\Tours\Service;

use App\Http\Requests\Tour\Private\StoreRequest;
use App\Models\Itineraries\PrivateTourItinerary;
use App\Models\Tours\PrivateTour;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;

class AdminPrivateTourService
{

    public function index($request): Collection
    {
        $search = $request->input('table_search', '');
        $departingDate = $request->input('departing_date', '');

        $query = PrivateTour::query()
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
                    });
            })
            ->when($departingDate, function ($query, $departingDate) {
                $query->whereDate('departing', $departingDate);
            });

        return $query->get();
    }

    public function store(StoreRequest $request): void
    {
        $data = $request->validated();

        // Обработка одиночного изображения
        if ($request->hasFile('image')) {
            $file = $request->file('image');
            $filePath = $file->store('images/privateTours', 'public');
            $data['image'] = '/storage/' . $filePath;
        }

        // Форматирование дат
        $data['departing'] = Carbon::parse($data['departing'])->format('Y-m-d');
        $data['finishing'] = Carbon::parse($data['finishing'])->format('Y-m-d');

        // Создание записи о туре
        $privateTour = PrivateTour::create($data);

        // Обработка нескольких изображений
        if ($request->hasFile('images')) {
            $images = $request->file('images');
            $imagePaths = [];

            foreach ($images as $image) {
                $filePath = $image->store('images/privateTours', 'public');
                $imagePaths[] = '/storage/' . $filePath;
            }

            // Сохранение путей к изображениям в базе данных
            $privateTour->images = json_encode($imagePaths);
            $privateTour->save();
        }

        // Создание записей для дня тура
        foreach ($data['days'] as $key => $dataDay) {
            $dataDay['day_number'] = (int)substr($key, 3, 1);
            $dataDay['tour_id'] = $privateTour->id;
            PrivateTourItinerary::create($dataDay);
        }
    }

    public function edit(array $data, $id): void
    {
        $tour = PrivateTour::findOrFail($id);

        $oldImagePath = $tour->image;

        // Обработка одиночного изображения
        if (isset($data['image']) && $data['image'] instanceof UploadedFile) {
            $image = $data['image'];
            $imagePath = $image->store('images/privateTours', 'public');
            $data['image'] = Storage::url($imagePath);

            if ($oldImagePath) {
                $oldImagePath = str_replace('/storage/', 'public/', $tour->image);
                if (Storage::exists($oldImagePath)) {
                    Storage::delete($oldImagePath);
                }
            }
        } else {
            $data['image'] = $tour->image;
        }

        // Обработка массива изображений
        if (isset($data['images']) && is_array($data['images'])) {
            // Получение старых путей
            $oldImagePaths = json_decode($tour->images, true);

            // Обработка новых изображений
            $newImagePaths = [];
            foreach ($data['images'] as $image) {
                if ($image instanceof UploadedFile) {
                    $filePath = $image->store('images/privateTours', 'public');
                    $newImagePaths[] = '/storage/' . $filePath;
                }
            }

            // Сохранение новых путей
            $data['images'] = json_encode($newImagePaths);

            // Удаление старых изображений, которые больше не присутствуют
            $oldImagePaths = array_diff($oldImagePaths, $newImagePaths);
            foreach ($oldImagePaths as $imagePath) {
                $imagePath = str_replace('/storage/', '', $imagePath);
                if (Storage::disk('public')->exists($imagePath)) {
                    Storage::disk('public')->delete($imagePath);
                }
            }
        } else {
            $data['images'] = $tour->images;
        }

        PrivateTourItinerary::where('tour_id', $id)->delete();

        foreach ($data['days'] as $key => $dataDay) {
            $dataDay['day_number'] = (int)substr($key, 3, 1);
            $dataDay['tour_id'] = $id;
            PrivateTourItinerary::create($dataDay);
        }
        // Обновление записи
        $tour->update($data);
    }

    public function delete($tour): void
    {
        // Удаление главного изображения
        if ($tour->image) {
            $imagePath = str_replace('/storage/', '', $tour->image);

            if (Storage::disk('public')->exists($imagePath)) {
                Storage::disk('public')->delete($imagePath);
            }
        }

        // Удаление изображений из массива 'images'
        if ($tour->images) {
            $imagePaths = json_decode($tour->images, true);

            foreach ($imagePaths as $imagePath) {
                $imagePath = str_replace('/storage/', '', $imagePath);

                if (Storage::disk('public')->exists($imagePath)) {
                    Storage::disk('public')->delete($imagePath);
                }
            }
        }

        // Удаление записи о туре
        $tour->delete();
    }
}

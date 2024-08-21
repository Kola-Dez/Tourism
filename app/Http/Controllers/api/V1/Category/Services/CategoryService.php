<?php

namespace App\Http\Controllers\api\V1\Category\Services;

use App\Models\Category\Category;
use App\Models\Tours\GroupTour;
use Carbon\Carbon;

class CategoryService
{

    public function getCategoryBySlug(string $slug): Category
    {
        [$id] = explode('-', $slug);
        return Category::query()->findOrFail($id);
    }

    public function nested(): array
    {
        return Category::all()->map(function ($category) {
            return [
                'title' => $category->translated_title,
                'slug' => $category->slug,
                'image' => $category->image,
            ];
        })->toArray();
    }

    public function getPopular(): array
    {
        $categories = Category::with(['groupTours'])->get();

        $allTours = collect();

        foreach ($categories as $category) {
            foreach ($category->groupTours as $groupTour) {
                $groupTour->table_name = 'group_tours';
                $allTours->push($groupTour);
            }
        }

        $topTours = $allTours->sortByDesc('hits')->take(3);

        return $topTours->values()->all();
    }

    public function show(Category $category): array
    {
        $data = [
            'title' => $category->translated_title,
            'slug' => $category->slug,
            'image' => $category->image,
        ];
        $data['group_tours'] = GroupTour::all()->where('category_id', $category->id)->where('status', 'available')->map(function ($groupTour) {
            $startDate = Carbon::parse($groupTour->departing);
            $endDate = Carbon::parse($groupTour->finishing);
            $duration = intval($startDate->diffInDays($endDate));
            return [
                'title' => $groupTour->title,
                'description' => $groupTour->description,
                'price' => $groupTour->price,
                'how_many_peoples' => $groupTour->how_many_peoples,
                'date' => $duration . 'D/' . $duration -1 . 'N',
//                'destination' => $groupTour->travel_destination_id->destination_id,
            ];
        });
        return $data;
    }
}

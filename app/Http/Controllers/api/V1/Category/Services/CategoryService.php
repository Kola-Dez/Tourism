<?php

namespace App\Http\Controllers\api\V1\Category\Services;

use App\Models\Category\Category;

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
                'id' => $category->id,
                'original_title' => $category->title,
                'translated_title' => $category->translated_title,
                'slug' => $category->slug,
                'image' => $category->image,
            ];
        })->toArray();
    }

    public function getPopular(): array
    {
        $categories = Category::with(['tours'])->get();

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
}

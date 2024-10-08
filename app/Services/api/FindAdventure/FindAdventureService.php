<?php

namespace App\Services\api\FindAdventure;

use App\Models\Category\Category;
use App\Models\Destination\Destination;
use App\Models\Tours\GroupTour;
use App\Models\Tours\PrivateTour;
use App\Resources\api\Tours\GroupTourResource;
use App\Resources\api\Tours\PrivateTourResource;

class FindAdventureService
{
    public function getCategoryBySlug(?string $slug): ?Category
    {
        if (is_null($slug)) {
            return null;
        }

        [$id] = explode('-', $slug);
        return Category::query()->find($id);
    }

    public function getDestinationBySlug(?string $slug): ?Destination
    {
        if (is_null($slug)) {
            return null;
        }

        [$id] = explode('-', $slug);
        return Destination::query()->find($id);
    }

    public function findAdventure($request): array
    {
        $monthName = $request->input('month');
        $destination = $this->getDestinationBySlug($request->input('destination'));
        $category = $this->getCategoryBySlug($request->input('category'));


        $monthNumber = $monthName ? date('m', strtotime($monthName)) : null;

        $groupTours = [];
        $privateTours = [];

        if ($destination && $category && $monthNumber) {
            $groupTours = $this->findGroupTours($destination, $category, $monthNumber);
            $privateTours = $this->findPrivateTours($destination, $category, $monthNumber);
        } elseif ($destination && $category) {
            $groupTours = $this->findGroupTours($destination, $category);
            $privateTours = $this->findPrivateTours($destination, $category);
        } elseif ($destination && $monthNumber) {
            $groupTours = $this->findGroupTours($destination, null, $monthNumber);
            $privateTours = $this->findPrivateTours($destination, null, $monthNumber);
        } elseif ($category && $monthNumber) {
            $groupTours = $this->findGroupTours(null, $category, $monthNumber);
            $privateTours = $this->findPrivateTours(null, $category, $monthNumber);
        } elseif ($destination) {
            $groupTours = $this->findGroupTours($destination);
            $privateTours = $this->findPrivateTours($destination);
        } elseif ($category) {
            $groupTours = $this->findGroupTours(null, $category);
            $privateTours = $this->findPrivateTours(null, $category);
        } elseif ($monthNumber) {
            $groupTours = $this->findGroupTours(null, null, $monthNumber);
            $privateTours = $this->findPrivateTours(null, null, $monthNumber);
        } else {
            $groupTours = $this->findGroupTours();
            $privateTours = $this->findPrivateTours();
        }

        return [
            'group' => $groupTours,
            'private' => $privateTours
        ];
    }

    private function findGroupTours(?Destination $destination = null, ?Category $category = null, ?int $monthNumber = null)
    {
        $query = GroupTour::query();

        if ($destination) {
            $query->whereHas('travelDestination', function ($q) use ($destination) {
                $q->where('destination_id', $destination->id);
            });
        }

        if ($category) {
            $query->where('category_id', $category->id);
        }

        if ($monthNumber) {
            $query->whereMonth('departing', $monthNumber);
        }

        return GroupTourResource::collection($query->get());
    }

    private function findPrivateTours(?Destination $destination = null, ?Category $category = null, ?int $monthNumber = null)
    {
        $query = PrivateTour::query();

        if ($destination) {
            $query->whereHas('travelDestination', function ($q) use ($destination) {
                $q->where('destination_id', $destination->id);
            });
        }

        if ($category) {
            $query->where('category_id', $category->id);
        }

        if ($monthNumber) {
            $query->whereMonth('departing', $monthNumber);
        }

        return PrivateTourResource::collection($query->get());
    }
}

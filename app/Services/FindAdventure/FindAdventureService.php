<?php

namespace App\Services\FindAdventure;

use App\Models\Category\Category;
use App\Models\Destination\Destination;
use App\Models\Tours\GroupTour;
use App\Models\Tours\PrivateTour;
use App\Models\TravelDestination\TravelDestination;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Response;

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

    public function findAdventure($request): JsonResponse
    {
        $monthName = $request->input('month');
        $destination = $this->getDestinationBySlug($request->input('destination'));
        $category = $this->getCategoryBySlug($request->input('category'));

        $monthNumber = $monthName ? date('m', strtotime($monthName)) : null;

        // Определение поиска по категориям
        if ($destination && $category && $monthNumber) {
            $tours = $this->findToursByDestinationCategoryMonth($destination, $category, $monthNumber);
        } elseif ($destination && $category) {
            $tours = $this->findToursByDestinationAndCategory($destination, $category);
        } elseif ($destination && $monthNumber) {
            $tours = $this->findToursByDestinationAndMonth($destination, $monthNumber);
        } elseif ($category && $monthNumber) {
            $tours = $this->findToursByCategoryAndMonth($category, $monthNumber);
        } elseif ($destination) {
            $tours = $this->findToursByDestination($destination);
        } elseif ($category) {
            $tours = $this->findToursByCategory($category);
        } elseif ($monthNumber) {
            $tours = $this->findToursByMonth($monthNumber);
        } else {
            $tours = $this->findAllTours();
        }

        return Response::json($tours, 200);
    }

    private function findToursByDestinationCategoryMonth(Destination $destination, Category $category, int $monthNumber)
    {
        return $this->findGroupTours($destination, $category, $monthNumber)
            ->merge($this->findPrivateTours($destination, $category, $monthNumber));
    }

    private function findToursByDestinationAndCategory(Destination $destination, Category $category)
    {
        return $this->findGroupTours($destination, $category)
            ->merge($this->findPrivateTours($destination, $category));
    }

    private function findToursByDestinationAndMonth(Destination $destination, int $monthNumber)
    {
        return $this->findGroupTours($destination, null, $monthNumber)
            ->merge($this->findPrivateTours($destination, null, $monthNumber));
    }

    private function findToursByCategoryAndMonth(Category $category, int $monthNumber)
    {
        return $this->findGroupTours(null, $category, $monthNumber)
            ->merge($this->findPrivateTours(null, $category, $monthNumber));
    }

    private function findToursByDestination(Destination $destination)
    {
        return $this->findGroupTours($destination)
            ->merge($this->findPrivateTours($destination));
    }

    private function findToursByCategory(Category $category)
    {
        return $this->findGroupTours(null, $category)
            ->merge($this->findPrivateTours(null, $category));
    }

    private function findToursByMonth(int $monthNumber)
    {
        return $this->findGroupTours(null, null, $monthNumber)
            ->merge($this->findPrivateTours(null, null, $monthNumber));
    }

    private function findAllTours()
    {
        return $this->findGroupTours()
            ->merge($this->findPrivateTours());
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

        return $query->get()->map(function ($groupTour) {
            return [
                'id' => $groupTour->id,
                'travel_destination' => $groupTour->travelDestination->translated_name,
                'destination' => $groupTour->travelDestination->destination->translated_code,
                'category' => $groupTour->category->translated_title,
                'how_many_peoples' => $groupTour->how_many_peoples,
                'price' => intval($groupTour->price),
                'title' => $groupTour->title,
                'image' => $groupTour->image,
                'date' => $groupTour->duration,
            ];
        });
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

        return $query->get()->map(function ($privateTour) {
            return [
                'id' => $privateTour->id,
                'travel_destination' => $privateTour->travelDestination->translated_name,
                'destination' => $privateTour->travelDestination->destination->translated_code,
                'category' => $privateTour->category->translated_title,
                'title' => $privateTour->title,
                'image' => $privateTour->image,
                'date' => $privateTour->duration,
            ];
        });
    }
}

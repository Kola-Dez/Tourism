<?php

namespace App\Http\Controllers\api\V1\Tours\Services;

use App\Models\Tours\GroupTour;
use Carbon\Carbon;

class GroupTourService
{
    public function show($id): array
    {
        $groupTour = GroupTour::findOrFail($id);

        $groupTour->hits++;
        $groupTour->save();

        $startDate = Carbon::parse($groupTour->departing);
        $endDate = Carbon::parse($groupTour->finishing);
        $duration = intval($startDate->diffInDays($endDate));

        return [
            'travel_destination' => __('messages.travel_destination.' . $groupTour->travelDestination->name),
            'destination' => __('messages.destination.' . $groupTour->travelDestination->destination->code),
            'people' => $groupTour->how_many_peoples,
            'image' => $groupTour->image,
            'price' => intval($groupTour->price),
            'description' => $groupTour->description,
            'date' => $duration . 'D/' . $duration -1 . 'N',
        ];
    }
}

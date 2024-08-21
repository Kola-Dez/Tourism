<?php

namespace App\Http\Controllers\api\V1\Tours\Services;

use App\Models\Tours\PrivateTour;
use Carbon\Carbon;

class PrivateTourService
{
    public function show($id): array
    {
        $privateTour = PrivateTour::findOrFail($id);

        $startDate = Carbon::parse($privateTour->departing);
        $endDate = Carbon::parse($privateTour->finishing);
        $duration = intval($startDate->diffInDays($endDate));

        return [
            'travel_destination' => __('messages.travel_destination.' . $privateTour->travelDestination->name),
            'destination' => __('messages.destination.' . $privateTour->travelDestination->destination->code),
            'image' => $privateTour->image,
            'description' => $privateTour->description,
            'date' => $duration . 'D/' . ($duration -1) . 'N',
        ];
    }
}

<?php

namespace App\Resources\Itinerary;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

/**
 * @property mixed $day_number
 * @property mixed $title
 * @property mixed $description
 */
class ItineraryResource extends JsonResource
{
    /**
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'day_number' => $this->day_number,
            'title' => $this->title,
            'description' => $this->description,
        ];
    }
}

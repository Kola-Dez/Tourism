<?php

namespace App\Resources\admin\Itinerary;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Carbon;

/**
 * @property mixed $image
 * @property mixed $description
 * @property mixed $destination
 * @property mixed $travelDestination
 * @property mixed $how_many_peoples
 * @property mixed $price
 * @property mixed $inclusions
 * @property mixed $exclusions
 * @property mixed $duration
 * @property mixed $id
 * @property mixed $category
 * @property mixed $departing
 * @property mixed $finishing
 * @property mixed $title
 * @property mixed $status
 * @property mixed $hits
 * @property mixed $day_number
 * @property mixed $tour_id
 */
class AdminItineraryResource extends JsonResource
{
    /**
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'tour_id' => $this->tour_id,
            'day_number' => $this->day_number,
            'title' => $this->title,
            'description' => $this->description,
        ];
    }
}

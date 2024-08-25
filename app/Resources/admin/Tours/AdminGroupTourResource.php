<?php

namespace App\Resources\admin\Tours;

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
 */
class AdminGroupTourResource extends JsonResource
{
    /**
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'travel_destination' => $this->travelDestination->name,
            'destination' => $this->travelDestination->destination->translated_code,
            'category' => $this->category->title,
            'image' => $this->image,
            'departing' => 'required|date_format:Y-m-d',
            'finishing' => 'required|date_format:Y-m-d|after_or_equal:departing',
            'title' => $this->title,
            'price' => intval($this->price),
            'description' => $this->description,
            'peoples' => $this->how_many_peoples,
            'status' => $this->status,
            'inclusions' => $this->inclusions,
            'exclusions' => $this->exclusions,
        ];
    }
}

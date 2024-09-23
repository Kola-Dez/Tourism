<?php

namespace App\Resources\admin\TravelDestination;

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
 * @property mixed $images
 * @property mixed $name
 * @property mixed $slug
 */
class AdminTravelDestinationResources extends JsonResource
{
    /**
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'name' => $this->name,
            'slug' => $this->slug,
            'image' => $this->image,
            'description' => $this->description,
            'destination_id' => $this->destination->id,
            'destination' => $this->destination->translated_code,
        ];
    }
}

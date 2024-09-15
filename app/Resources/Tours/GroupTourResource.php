<?php

namespace App\Resources\Tours;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

/**
 * @property mixed $image
 * @property mixed $images
 * @property mixed $description
 * @property mixed $destination
 * @property mixed $travelDestination
 * @property mixed $how_many_peoples
 * @property mixed $price
 * @property mixed $inclusions
 * @property mixed $exclusions
 * @property mixed $duration
 * @property mixed $id
 */
class GroupTourResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'travel_destination' => $this->travelDestination->translated_name,
            'destination' => $this->travelDestination->destination->translated_code,
            'image' => $this->image,
            'date' => $this->duration,
            'images' => $this->images ?? [],
            'price' => intval($this->price),
            'description' => $this->description,
            'peoples' => $this->how_many_peoples,
            'inclusions' => $this->inclusions,
            'exclusions' => $this->exclusions,
        ];
    }
}

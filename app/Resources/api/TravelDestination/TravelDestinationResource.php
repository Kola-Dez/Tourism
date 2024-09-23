<?php

namespace App\Resources\api\TravelDestination;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

/**
 * @property mixed $translated_name
 * @property mixed $slug
 * @property mixed $image
 * @property mixed $description
 * @property mixed $destination
 */
class TravelDestinationResource extends JsonResource
{
    /**
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'name' => $this->translated_name,
            'slug' => $this->slug,
            'image' => $this->image,
            'description' => $this->description,
            'destination' => $this->destination->translated_code,
            'destination_slug' => $this->destination->slug,
        ];
    }
}

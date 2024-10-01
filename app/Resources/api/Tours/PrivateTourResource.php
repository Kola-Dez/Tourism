<?php

namespace App\Resources\api\Tours;

use App\Resources\api\Category\CategoryResource;
use App\Resources\api\TravelDestination\TravelDestinationResource;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

/**
 * @property mixed $translated_name
 * @property mixed $image
 * @property mixed $description
 * @property mixed $destination
 * @property mixed $travelDestination
 * @property mixed $inclusions
 * @property mixed $exclusions
 * @property mixed $duration
 * @property mixed $id
 * @property mixed $category
 */
class PrivateTourResource extends JsonResource
{
    /**
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'image' => $this->image,
            'date' => $this->duration,
            'description' => $this->description,
            'inclusions' => $this->inclusions,
            'exclusions' => $this->exclusions,
            'travel_destination' => new TravelDestinationResource($this->travelDestination),
            'category' => new CategoryResource($this->category),
        ];
    }
}

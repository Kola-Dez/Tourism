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
 * @property mixed $images
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
            'travel_destination_slug' => $this->travelDestination->slug,
            'destination' => $this->travelDestination->destination->translated_code,
            'destination_slug' => $this->travelDestination->destination->slug,
            'category' => $this->category->title,
            'category_slug' => $this->category->slug,
            'image' => $this->image,
            'images' => json_decode($this->images),
            'departing' => Carbon::parse($this->departing)->format('Y-m-d'),
            'finishing' => Carbon::parse($this->finishing)->format('Y-m-d'),
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

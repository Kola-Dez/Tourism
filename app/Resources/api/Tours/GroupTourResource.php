<?php

namespace App\Resources\api\Tours;

use App\Models\Language\Language;
use App\Resources\api\Category\CategoryResource;
use App\Resources\api\Destination\DestinationResource;
use App\Resources\api\TravelDestination\TravelDestinationResource;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

/**
 * @property mixed $image
 * @property mixed $images
 * @property mixed $description
 * @property mixed $travelDestination
 * @property mixed $how_many_peoples
 * @property mixed $price
 * @property mixed $inclusions
 * @property mixed $exclusions
 * @property mixed $duration
 * @property mixed $id
 * @property mixed $category
 * @property mixed $destination
 */
class GroupTourResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'image' => $this->image,
            'date' => $this->duration,
            'images' => $this->images ?? [],
            'price' => intval($this->price),
            'description' => $this->description,
            'peoples' => $this->how_many_peoples,
            'inclusions' => $this->inclusions,
            'exclusions' => $this->exclusions,
            'travel_destination' => new TravelDestinationResource($this->travelDestination),
            'category' => new CategoryResource($this->category),
        ];
    }

    private function getLanguageId()
    {
        $locale = app()->getLocale();

        return Language::where('code', $locale)->value('id');
    }
}

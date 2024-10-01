<?php

namespace App\Resources\admin\TravelDestinationLanguage;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

/**
 * @property mixed $description
 * @property mixed $translate_name
 * @property mixed $id
 * @property mixed $destination
 * @property mixed $language
 * @property mixed $translate_description
 * @property mixed $travel_destination
 */
class AdminTravelDestinationLanguageResource extends JsonResource
{
    /**
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'translate_name' => $this->translate_name,
            'translate_description' => $this->translate_description,
            'name' => $this->travel_destination->name,
            'description' => $this->travel_destination->description,
            'language' => $this->language->name,
            'code' => $this->language->code,
        ];
    }
}

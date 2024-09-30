<?php

namespace App\Resources\api\TravelDestination;

use App\Models\Language\Language;
use App\Resources\api\Destination\DestinationResource;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

/**
 * @property mixed $translated_name
 * @property mixed $slug
 * @property mixed $image
 * @property mixed $description
 * @property mixed $destination
 * @property mixed $name
 */
class TravelDestinationResource extends JsonResource
{
    /**
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        $translation = $this->translations()->where('language_id', $this->getLanguageId())->first();

        return [
            'name' => $translation ? $translation->translate_name : $this->name,
            'slug' => $this->slug,
            'image' => $this->image,
            'description' => $this->description,
            'destination' => new DestinationResource($this->destination),
            'destination_slug' => $this->destination->slug,
        ];
    }

    private function getLanguageId()
    {
        $locale = app()->getLocale();

        return Language::where('code', $locale)->value('id');
    }
}


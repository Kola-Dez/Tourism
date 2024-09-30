<?php

namespace App\Resources\api\Destination;

use App\Models\Language\Language;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

/**
 * @property mixed $slug
 * @property mixed $image
 * @property mixed $description
 * @property mixed $translations
 * @property mixed $name
 */
class DestinationResource extends JsonResource
{
    /**
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        $translation = $this->translations()->where('language_id', $this->getLanguageId())->first();

        return [
            'name' => $translation ? $translation->translate_name : $this->name,
            'image' => $this->image,
            'slug' => $this->slug,
            'description' => $this->description,
        ];
    }

    private function getLanguageId()
    {
        $locale = app()->getLocale();

        return Language::where('code', $locale)->value('id');
    }
}

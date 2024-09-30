<?php

namespace App\Resources\api\Category;

use App\Models\Language\Language;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

/**
 * @property mixed $slug
 * @property mixed $image
 * @property mixed $translated_title
 * @property mixed $description
 * @property mixed $title
 * @method translations()
 */
class CategoryResource extends JsonResource
{
    /**
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        $translation = $this->translations()->where('language_id', $this->getLanguageId())->first();

        return [
            'title' => $translation ? $translation->translate_name : $this->title,
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

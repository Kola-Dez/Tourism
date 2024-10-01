<?php

namespace App\Resources\admin\CategoryLanguage;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

/**
 * @property mixed $description
 * @property mixed $id
 * @property mixed $language
 * @property mixed $translate_description
 * @property mixed $translate_title
 * @property mixed $category
 */
class AdminCategoryLanguageResource extends JsonResource
{
    /**
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'translate_title' => $this->translate_title,
            'translate_description' => $this->translate_description,
            'title' => $this->category->title,
            'description' => $this->category->description,
            'language' => $this->language->name,
            'code' => $this->language->code,
        ];
    }
}

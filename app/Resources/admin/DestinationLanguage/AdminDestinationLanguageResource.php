<?php

namespace App\Resources\admin\DestinationLanguage;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

/**
 * @property mixed $description
 * @property mixed $translate_name
 * @property mixed $id
 * @property mixed $destination
 * @property mixed $language
 * @property mixed $translate_description
 */
class AdminDestinationLanguageResource extends JsonResource
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
            'name' => $this->destination->name,
            'description' => $this->destination->description,
            'language' => $this->language->name,
            'code' => $this->language->code,
        ];
    }
}

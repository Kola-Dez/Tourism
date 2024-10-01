<?php

namespace App\Resources\admin\Language;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

/**
 * @property mixed $slug
 * @property mixed $image
 * @property mixed $description
 * @property mixed $translated_code
 * @property mixed $id
 * @property mixed $code
 * @property mixed $name
 */
class AdminLanguageResource extends JsonResource
{
    /**
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'name' => $this->name,
            'code' => $this->code,
        ];
    }
}

<?php

namespace App\Resources\admin\Category;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

/**
 * @property mixed $slug
 * @property mixed $image
 * @property mixed $translated_title
 * @property mixed $id
 */
class AdminCategoryResource extends JsonResource
{
    /**
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'title' => $this->translated_title,
            'slug' => $this->slug,
            'image' => $this->image,
        ];
    }
}

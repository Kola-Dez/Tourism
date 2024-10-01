<?php

namespace App\Resources\admin\Destination;

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
class AdminDestinationResource extends JsonResource
{
    /**
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'name' => $this->name,
            'name_original' => $this->name,
            'image' => $this->image,
            'slug' => $this->slug,
            'description' => $this->description,
        ];
    }
}

<?php

namespace App\Resources\admin\Blog;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Carbon;

/**
 * @property mixed $image
 * @property mixed $description
 * @property mixed $destination
 * @property mixed $id
 * @property mixed $title
 */
class AdminBlogResource extends JsonResource
{
    /**
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'destination' => $this->destination->name,
            'destination_slug' => $this->destination->slug,
            'destination_id' => $this->destination->id,
            'title' => $this->title,
            'image' => $this->image,
            'description' => $this->description,
        ];
    }
}

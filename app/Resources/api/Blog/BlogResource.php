<?php

namespace App\Resources\api\Blog;

use App\Models\Language\Language;
use App\Resources\api\Destination\DestinationResource;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

/**
 * @property mixed $title
 * @property mixed $image
 * @property mixed $destination
 * @property mixed $description
 * @property mixed $id
 */
class BlogResource extends JsonResource
{

    /**
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'title' =>  $this->title,
            'image' => $this->image,
            'description' => $this->description,
            'destination' => new DestinationResource($this->destination),
        ];
    }

    private function getLanguageId()
    {
        $locale = app()->getLocale();

        return Language::where('code', $locale)->value('id');
    }
}

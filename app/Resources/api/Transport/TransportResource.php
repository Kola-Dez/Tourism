<?php

namespace App\Resources\api\Transport;

use Illuminate\Http\Resources\Json\JsonResource;

/**
 * @property mixed $id
 * @property mixed $destination
 * @property mixed $image
 * @property mixed $direction
 * @property mixed $sedan
 * @property mixed $van
 * @property mixed $suv
 * @property mixed $mini_van
 */
class TransportResource extends JsonResource
{
    public function toArray($request): array
    {
        return [
            'id' => $this->id,
            'destination' => $this->destination->translated_code,
            'image' => $this->image,
            'direction' => $this->direction,
            'sedan' => intval($this->sedan),
            'van' => intval($this->van),
            'suv' => intval($this->suv),
            'mini_van' => intval($this->mini_van),
        ];
    }
}

<?php

namespace App\Models\TravelDestination;

use App\Models\Destination\Destination;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * @method static create(array $array)
 */
class TravelDestination extends Model
{
    use HasFactory;

    protected $fillable = [
        'destination_id',
        'name',
        'slug',
        'image',
        'description',
    ];

    public function destination(): BelongsTo
    {
        return $this->belongsTo(Destination::class);
    }
}

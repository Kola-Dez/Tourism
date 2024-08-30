<?php

namespace App\Models\Transport;

use App\Models\Destination\Destination;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * @method static where(string $string, mixed $id)
 */
class Transport extends Model
{
    protected $table = 'transports';
    protected $fillable = [
        'destination_id',
        'image',
        'direction',
        'sedan',
        'van',
        'suv',
        'mini_van',
    ];

    public function destination(): BelongsTo
    {
        return $this->belongsTo(Destination::class);
    }
}

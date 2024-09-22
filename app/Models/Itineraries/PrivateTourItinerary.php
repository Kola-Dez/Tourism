<?php

namespace App\Models\Itineraries;

use App\Models\Tours\PrivateTour;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * @method static create(array $array)
 */
class PrivateTourItinerary extends Model
{
    use HasFactory;

    protected $table = 'private_tour_itineraries';

    protected $fillable = ['tour_id', 'title', 'day_number', 'description'];

    public function tour(): BelongsTo
    {
        return $this->belongsTo(PrivateTour::class, 'tour_id');
    }
}

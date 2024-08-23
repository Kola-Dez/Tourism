<?php

namespace App\Models\Itineraries;

use App\Models\Tours\GroupTour;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * @method static create(array $array)
 */
class GroupTourItinerary extends Model
{
    use HasFactory;

    protected $table = 'group_tour_itineraries';

    protected $fillable = ['tour_id', 'day_number', 'description'];

    public function tour(): BelongsTo
    {
        return $this->belongsTo(GroupTour::class, 'tour_id');
    }
}

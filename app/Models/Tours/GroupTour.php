<?php

namespace App\Models\Tours;

use App\Models\Category\Category;
use App\Models\TravelDestination\TravelDestination;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * @method static create(array $data)
 * @method static findOrFail($id)
 */
class GroupTour extends Model
{
    use HasFactory;

    protected $fillable = [
        'category_id',
        'travel_destination_id',
        'title',
        'image',
        'description',
        'inclusions',
        'exclusions',
        'price',
        'how_many_peoples',
        'hits',
        'status',
        'departing',
        'finishing',
    ];

    public function category(): BelongsTo
    {
        return $this->belongsTo(Category::class);
    }

    public function travelDestination(): BelongsTo
    {
        return $this->belongsTo(TravelDestination::class);
    }
}

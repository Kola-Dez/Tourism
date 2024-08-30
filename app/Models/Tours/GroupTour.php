<?php

namespace App\Models\Tours;

use App\Models\Category\Category;
use App\Models\TravelDestination\TravelDestination;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

/**
 * @method static create(array $data)
 * @method static findOrFail($id)
 * @method static find($id)
 * @method static where(string $string, mixed $id)
 * @method static whereMonth(string $string, string $monthNumber)
 * @property mixed $departing
 * @property mixed $finishing
 * @property mixed $id
 * @property int|mixed $hits
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

    public function getDurationAttribute(): string
    {
        $startDate = Carbon::parse($this->departing);
        $endDate = Carbon::parse($this->finishing);
        $duration = intval($startDate->diffInDays($endDate));

        return $duration . 'D/' . ($duration - 1) . 'N';
    }
}

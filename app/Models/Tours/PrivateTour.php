<?php

namespace App\Models\Tours;

use App\Models\Category\Category;
use App\Models\Destination\Destination;
use App\Models\TravelDestination\TravelDestination;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * @property int $id
 * @property int $category_id
 * @property string $title
 * @property string $image
 * @property string $description
 * @property mixed $category
 * @property mixed $travelDestination
 * @property mixed $departing
 * @property mixed $finishing
 * @property int|mixed $hits
 * @method static static create(array $data)
 * @method static static findOrFail(string $id)
 * @method static find($id)
 * @method static where(string $string, $id)
 */
class PrivateTour extends Model
{
    use HasFactory;
    protected $fillable = [
        'title',
        'image',
        'description',
        'category_id',
        'travel_destination_id',
        'inclusions',
        'exclusions',
        'departing',
        'finishing',
        'hits',
    ];

    protected $casts = [
        'price' => 'float',
        'how_many_peoples' => 'integer',
        'hits' => 'integer',
        'start_date' => 'date',
        'end_date' => 'date',
        'status' => 'string',
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

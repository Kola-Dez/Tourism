<?php

namespace App\Models\Tours;

use App\Models\Category\Category;
use App\Models\Country\Country;
use App\Models\Destination\Destination;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Support\Carbon;

/**
 * @property int $id
 * @property int $category_id
 * @property string $title
 * @property string $image
 * @property string $description
 * @property float $price
 * @property int $how_many_peoples
 * @property int $hits
 * @property string $status
 * @property Carbon $start_date
 * @property Carbon $end_date
 * @method static static create(array $data)
 * @method static static findOrFail(string $id)
 */
class PrivateTour extends Model
{
    use HasFactory;
    protected $fillable = [
        'title',
        'image',
        'description',
        'category_id',
        'inclusions',
        'exclusions',
        'departing',
        'finishing',
    ];

    protected $casts = [
        'price' => 'float',
        'how_many_peoples' => 'integer',
        'hits' => 'integer',
        'start_date' => 'date',
        'end_date' => 'date',
        'status' => 'string',
    ];

    // Отношения
    public function category(): BelongsTo
    {
        return $this->belongsTo(Category::class);
    }
    public function destinations(): BelongsToMany
    {
        return $this->belongsToMany(Destination::class, 'tour_destinations', 'tour_id', 'destination_id');
    }
}

<?php

namespace App\Models\Destination;

use App\Models\TravelDestination\TravelDestination;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

/**
 * @method static create(array $array)
 * @method static where(string $string, string $string1)
 */
class Destination extends Model
{
    use HasFactory;

    protected $fillable = [
        'code',
        'slug',
        'image',
        'description',
    ];

    public function travelDestination(): HasMany
    {
        return $this->hasMany(TravelDestination::class);
    }

}

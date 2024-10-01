<?php

namespace App\Models\Destination;

use App\Models\DestinationTranslation\DestinationTranslation;
use App\Models\TravelDestination\TravelDestination;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Str;

/**
 * @method static create(array $array)
 * @method static where(string $string, string $string1)
 * @property mixed $id
 * @property mixed $name
 * @property mixed $translated_code
 * @property mixed $image
 * @property mixed $description
 * @property mixed $travelDestination
 * @property mixed $slug
 */
class Destination extends Model
{
    use HasFactory;

    protected $table = 'destinations';

    protected $fillable = [
        'name',
        'image',
        'slug',
        'description',
    ];

    public function travelDestination(): HasMany
    {
        return $this->hasMany(TravelDestination::class);
    }

    public function translations(): HasMany
    {
        return $this->hasMany(DestinationTranslation::class);
    }

    public static function boot(): void
    {
        parent::boot();

        static::creating(function(Destination $destination) {
            $destination->slug = Str::slug($destination->name, '-');
        });

        static::created(function(Destination $destination) {
            $destination->slug = $destination->id . '-' . $destination->slug;
            $destination->save();
        });

        static::updating(function(Destination $destination) {
            $destination->slug = $destination->id . '-' . Str::slug($destination->name, '-');
        });
    }
}

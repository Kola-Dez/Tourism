<?php

namespace App\Models\TravelDestination;

use App\Models\Destination\Destination;
use App\Models\Tours\GroupTour;
use App\Models\Tours\PrivateTour;
use App\Models\TravelDestinationTranslation\TravelDestinationTranslation;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\Relation;
use Illuminate\Support\Str;

/**
 * @method static create(array $array)
 * @method static where(string $string, mixed $id)
 * @property mixed $translated_name
 * @property mixed $image
 * @property mixed $description
 * @property mixed $destination_id
 * @property mixed $destination
 * @property mixed $slug
 * @property mixed $name
 * @property mixed $id
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

    public function groupTours(): HasMany
    {
        return $this->hasMany(GroupTour::class);
    }

    public function privateTours(): HasMany
    {
        return $this->hasMany(PrivateTour::class);
    }

    public function destination(): BelongsTo
    {
        return $this->belongsTo(Destination::class);
    }

    public function translations(): HasMany
    {
        return $this->hasMany(TravelDestinationTranslation::class);
    }

    public static function boot(): void
    {
        parent::boot();

        static::creating(function(TravelDestination $travelDestination) {
            $travelDestination->slug = Str::slug($travelDestination->name, '-');
        });

        static::created(function(TravelDestination $travelDestination) {
            $travelDestination->slug = $travelDestination->id . '-' . $travelDestination->slug;
            $travelDestination->save();
        });

        static::updating(function(TravelDestination $travelDestination) {
            $travelDestination->slug = $travelDestination->id . '-' . Str::slug($travelDestination->name, '-');
        });
    }
}

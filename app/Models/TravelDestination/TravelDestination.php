<?php

namespace App\Models\TravelDestination;

use App\Models\Destination\Destination;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\Relation;
use Illuminate\Support\Str;

/**
 * @method static create(array $array)
 * @property mixed $translated_name
 * @property mixed $image
 * @property mixed $description
 * @property mixed $destination_id
 * @property mixed $destination
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

    public function destination(): BelongsTo
    {
        return $this->belongsTo(Destination::class);
    }




    public function getTranslatedNameAttribute(): string
    {
        return __('messages.travel_destination.' . $this->getAttribute('name'));
    }

    public function getSlugAttribute(): string
    {
        return Str::slug($this->attributes['id'] . ' ' . $this->attributes['slug']);
    }

    public function resolveRouteBinding($value, $field = null)
    {
        $model = $this->resolveRouteBindingQuery($this, $value, $field)->first();

        if (!$model) {
            throw (new ModelNotFoundException)->setModel(static::class, $value);
        }
        return $model;
    }

    public function resolveRouteBindingQuery($query, $value, $field = null): Model|Relation|Builder
    {
        [$id]  = explode('-', $value);

        return $query->where($field ?? $this->getRouteKeyName(), $id);
    }
}

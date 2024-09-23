<?php

namespace App\Models\Destination;

use App\Models\TravelDestination\TravelDestination;
use Illuminate\Contracts\Translation\Translator;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\Relation;
use Illuminate\Foundation\Application;
use Illuminate\Support\Str;

/**
 * @method static create(array $array)
 * @method static where(string $string, string $string1)
 * @property mixed $id
 * @property mixed $translated_code
 * @property mixed $image
 * @property mixed $description
 * @property mixed $travelDestination
 * @property mixed $slug
 */
class Destination extends Model
{
    use HasFactory;

    protected $fillable = [
        'code',
        'image',
        'slug',
        'description',
    ];

    public function travelDestination(): HasMany
    {
        return $this->hasMany(TravelDestination::class);
    }



    public function getTranslatedCodeAttribute(): string
    {
        return __('messages.destination.' . $this->getAttribute('code')) !== 'messages.destination.' . $this->getAttribute('code') ?
            __('messages.destination.' . $this->getAttribute('code')):
            $this->getAttribute('code');
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
        [$id] = explode('-', $value);

        return $query->where($field ?? $this->getRouteKeyName(), $id);
    }
}

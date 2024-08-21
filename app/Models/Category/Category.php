<?php

namespace App\Models\Category;

use App\Models\Tours\GroupTour;
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
 */
class Category extends Model
{
    use HasFactory;

    protected $fillable = ['title', 'slug', 'thumbnail'];

    public function getTranslatedTitleAttribute(): Application|array|string|Translator|null
    {
        return __('messages.categories.' . $this->getAttribute('title'));
    }

    public function groupTours(): HasMany
    {
        return $this->hasMany(GroupTour::class);
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

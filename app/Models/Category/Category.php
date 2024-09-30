<?php

namespace App\Models\Category;

use App\Models\CategoryTranslation\CategoryTranslation;
use App\Models\Tours\GroupTour;
use App\Models\Tours\PrivateTour;
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
 * @property mixed $title
 * @property mixed $translated_title
 * @property mixed $id
 * @property mixed $slug
 */
class Category extends Model
{
    use HasFactory;

    protected $fillable = ['title', 'slug', 'image'];

    public function groupTours(): HasMany
    {
        return $this->hasMany(GroupTour::class);
    }

    public function privateTours(): HasMany
    {
        return $this->hasMany(PrivateTour::class);
    }

    public function translations(): HasMany
    {
        return $this->hasMany(CategoryTranslation::class);
    }

    public static function boot(): void
    {
        parent::boot();

        static::creating(function(Category $category) {
            $category->slug = Str::slug($category->title, '-');
        });

        static::created(function(Category $category) {
            $category->slug = $category->id . '-' . $category->slug;
            $category->save();
        });

        static::updating(function(Category $category) {
            $category->slug = $category->id . '-' . Str::slug($category->title, '-');
        });
    }
}

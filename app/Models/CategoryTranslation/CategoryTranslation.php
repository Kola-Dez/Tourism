<?php

namespace App\Models\CategoryTranslation;

use App\Models\Category\Category;
use App\Models\Language\Language;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class CategoryTranslation extends Model
{
    protected $table = 'category_translations';

    protected $fillable = [
        'category_id',
        'language_id',
        'translate_title',
        'translate_description'
    ];

    public function category(): BelongsTo
    {
        return $this->belongsTo(Category::class);
    }

    public function language(): BelongsTo
    {
        return $this->belongsTo(Language::class);
    }
}

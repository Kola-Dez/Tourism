<?php

namespace App\Models\Blog;

use App\Models\Destination\Destination;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * @method static create(array $array)
 */
class Blog extends Model
{
    protected $table = 'blogs';
    protected $fillable = [
        'title',
        'description',
        'image',
        'destination_id',
    ];

    public function destination(): BelongsTo
    {
        return $this->belongsTo(Destination::class);
    }
}

<?php

namespace App\Models\Language;

use Illuminate\Database\Eloquent\Model;

/**
 * @method static pluck(string $string)
 * @method static where(string $string, string $locale)
 */
class Language extends Model
{
    protected $table = 'languages';

    protected $fillable = [
        'code',
        'name',
    ];

}

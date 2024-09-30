<?php

namespace App\Models\DestinationTranslation;

use App\Models\Destination\Destination;
use App\Models\Language\Language;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class DestinationTranslation extends Model
{
    protected $table = 'destination_translations';

    protected $fillable = [
        'destination_id',
        'language_id',
        'translation_name',
    ];

    public function destination(): BelongsTo
    {
        return $this->belongsTo(Destination::class);
    }

    public function language(): BelongsTo
    {
        return $this->belongsTo(Language::class);
    }
}

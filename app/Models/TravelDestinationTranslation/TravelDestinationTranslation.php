<?php

namespace App\Models\TravelDestinationTranslation;

use App\Models\Language\Language;
use App\Models\TravelDestination\TravelDestination;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class TravelDestinationTranslation extends Model
{

    protected $table = 'travel_destination_translations';

    protected $fillable = [
        'travel_destination_id',
        'language_id',
        'translate_name',
        'translate_description'
    ];

    public function travel_destination(): BelongsTo
    {
        return $this->belongsTo(TravelDestination::class);
    }

    public function language(): BelongsTo
    {
        return $this->belongsTo(Language::class);
    }
}

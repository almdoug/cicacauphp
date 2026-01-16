<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\MorphTo;

class DataSeries extends Model
{
    protected $fillable = [
        'dataable_type',
        'dataable_id',
        'date',
        'value',
        'label',
        'note',
    ];

    protected $casts = [
        'date' => 'date',
        'value' => 'decimal:2',
    ];

    /**
     * Relacionamento polimórfico
     */
    public function dataable(): MorphTo
    {
        return $this->morphTo();
    }
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Support\Str;

class ProductionCost extends Model
{
    protected $fillable = [
        'title',
        'slug',
        'frequency',
        'country',
        'source',
        'unit',
        'comment',
        'updated_at_data',
    ];

    protected $casts = [
        'updated_at_data' => 'datetime',
    ];



    /**
     * Boot do modelo
     */
    protected static function boot()
    {
        parent::boot();

        static::creating(function ($cost) {
            if (empty($cost->slug)) {
                $cost->slug = Str::slug($cost->title);
            }
            
            // Garantir slug único
            $originalSlug = $cost->slug;
            $count = 1;
            while (static::where('slug', $cost->slug)->exists()) {
                $cost->slug = $originalSlug . '-' . $count++;
            }
        });

        static::updating(function ($cost) {
            if ($cost->isDirty('title') && !$cost->isDirty('slug')) {
                $cost->slug = Str::slug($cost->title);
                
                $originalSlug = $cost->slug;
                $count = 1;
                while (static::where('slug', $cost->slug)->where('id', '!=', $cost->id)->exists()) {
                    $cost->slug = $originalSlug . '-' . $count++;
                }
            }
        });
    }

    /**
     * Relacionamento com séries de dados
     */
    public function dataSeries()
    {
        return $this->morphMany(DataSeries::class, 'dataable')->orderBy('date');
    }

    /**
     * Obter data de atualização formatada
     */
    public function getFormattedUpdatedAtData(): ?string
    {
        return $this->updated_at_data?->format('d/m/Y');
    }
}

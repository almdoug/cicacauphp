<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Support\Str;

class MarketData extends Model
{
    protected $table = 'market_data';

    protected $fillable = [
        'title',
        'slug',
        'frequency',
        'location',
        'source',
        'source_link',
        'unit',
        'comment',
        'updated_at_data',
        'published_at',
    ];

    protected $casts = [
        'updated_at_data' => 'datetime',
        'published_at' => 'datetime',
    ];

    /**
     * Boot do modelo
     */
    protected static function boot()
    {
        parent::boot();

        static::creating(function ($data) {
            if (empty($data->slug)) {
                $data->slug = Str::slug($data->title);
            }
            
            // Garantir slug único
            $originalSlug = $data->slug;
            $count = 1;
            while (static::where('slug', $data->slug)->exists()) {
                $data->slug = $originalSlug . '-' . $count++;
            }
        });

        static::updating(function ($data) {
            if ($data->isDirty('title') && !$data->isDirty('slug')) {
                $data->slug = Str::slug($data->title);
                
                $originalSlug = $data->slug;
                $count = 1;
                while (static::where('slug', $data->slug)->where('id', '!=', $data->id)->exists()) {
                    $data->slug = $originalSlug . '-' . $count++;
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

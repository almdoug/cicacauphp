<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Support\Str;

class ProductionCost extends Model
{
    protected $fillable = [
        'user_id',
        'title',
        'slug',
        'summary',
        'content',
        'type',
        'region',
        'period',
        'value',
        'unit',
        'source',
        'file',
        'external_link',
        'published_at',
    ];

    protected $casts = [
        'published_at' => 'datetime',
        'value' => 'decimal:2',
    ];

    /**
     * Tipos de custos de produção
     */
    public const TYPES = [
        'insumos' => 'Insumos',
        'mao_de_obra' => 'Mão de Obra',
        'equipamentos' => 'Equipamentos',
        'transporte' => 'Transporte',
        'processamento' => 'Processamento',
        'geral' => 'Geral',
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
     * Relacionamento com usuário
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Scope para itens publicados
     */
    public function scopePublished($query)
    {
        return $query->whereNotNull('published_at')
                     ->where('published_at', '<=', now());
    }

    /**
     * Scope para rascunhos
     */
    public function scopeDraft($query)
    {
        return $query->whereNull('published_at');
    }

    /**
     * Scope por tipo
     */
    public function scopeOfType($query, $type)
    {
        return $query->where('type', $type);
    }

    /**
     * Scope por região
     */
    public function scopeOfRegion($query, $region)
    {
        return $query->where('region', $region);
    }

    /**
     * Verificar se está publicado
     */
    public function isPublished(): bool
    {
        return $this->published_at !== null && $this->published_at <= now();
    }

    /**
     * Obter nome do tipo
     */
    public function getTypeName(): string
    {
        return self::TYPES[$this->type] ?? $this->type;
    }

    /**
     * Obter valor formatado
     */
    public function getFormattedValue(): ?string
    {
        if (!$this->value) {
            return null;
        }
        
        $formatted = 'R$ ' . number_format($this->value, 2, ',', '.');
        
        if ($this->unit) {
            $formatted .= ' ' . $this->unit;
        }
        
        return $formatted;
    }

    /**
     * Obter URL do arquivo
     */
    public function getFileUrl(): ?string
    {
        if (!$this->file) {
            return null;
        }
        
        return asset('storage/' . $this->file);
    }

    /**
     * Obter data de publicação formatada
     */
    public function getFormattedPublishedAt(): ?string
    {
        return $this->published_at?->format('d/m/Y');
    }

    /**
     * Obter lista de regiões únicas
     */
    public static function getUniqueRegions()
    {
        return static::whereNotNull('region')
                     ->distinct()
                     ->pluck('region')
                     ->sort()
                     ->values();
    }

    /**
     * Obter lista de períodos únicos
     */
    public static function getUniquePeriods()
    {
        return static::whereNotNull('period')
                     ->distinct()
                     ->pluck('period')
                     ->sortDesc()
                     ->values();
    }
}

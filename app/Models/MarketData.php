<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Support\Str;

class MarketData extends Model
{
    protected $table = 'market_data';

    protected $fillable = [
        'user_id',
        'title',
        'slug',
        'summary',
        'content',
        'category',
        'scope',
        'region',
        'period',
        'value',
        'unit',
        'variation',
        'source',
        'file',
        'external_link',
        'published_at',
    ];

    protected $casts = [
        'published_at' => 'datetime',
        'value' => 'decimal:2',
        'variation' => 'decimal:2',
    ];

    /**
     * Categorias de dados de mercado
     */
    public const CATEGORIES = [
        'producao' => 'Produção',
        'precos' => 'Preços',
        'exportacao' => 'Exportação',
        'importacao' => 'Importação',
    ];

    /**
     * Escopos de mercado
     */
    public const SCOPES = [
        'nacional' => 'Nacional',
        'internacional' => 'Internacional',
        'ambos' => 'Nacional e Internacional',
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
     * Scope por categoria
     */
    public function scopeOfCategory($query, $category)
    {
        return $query->where('category', $category);
    }

    /**
     * Scope por escopo (nacional/internacional)
     */
    public function scopeOfScope($query, $scope)
    {
        if ($scope === 'ambos') {
            return $query;
        }
        return $query->whereIn('scope', [$scope, 'ambos']);
    }

    /**
     * Verificar se está publicado
     */
    public function isPublished(): bool
    {
        return $this->published_at !== null && $this->published_at <= now();
    }

    /**
     * Obter nome da categoria
     */
    public function getCategoryName(): string
    {
        return self::CATEGORIES[$this->category] ?? $this->category;
    }

    /**
     * Obter nome do escopo
     */
    public function getScopeName(): string
    {
        return self::SCOPES[$this->scope] ?? $this->scope;
    }

    /**
     * Obter cor da categoria
     */
    public function getCategoryColor(): string
    {
        return match($this->category) {
            'producao' => 'green',
            'precos' => 'blue',
            'exportacao' => 'purple',
            'importacao' => 'orange',
            default => 'gray',
        };
    }

    /**
     * Obter valor formatado
     */
    public function getFormattedValue(): ?string
    {
        if (!$this->value) {
            return null;
        }
        
        // Detectar se é valor monetário pela unidade
        $isMonetary = str_contains(strtolower($this->unit ?? ''), 'r$') || 
                      str_contains(strtolower($this->unit ?? ''), 'us$') ||
                      str_contains(strtolower($this->unit ?? ''), '$');
        
        if ($isMonetary) {
            $formatted = number_format($this->value, 2, ',', '.');
        } else {
            $formatted = number_format($this->value, 0, ',', '.');
        }
        
        if ($this->unit) {
            $formatted .= ' ' . $this->unit;
        }
        
        return $formatted;
    }

    /**
     * Obter variação formatada
     */
    public function getFormattedVariation(): ?string
    {
        if ($this->variation === null) {
            return null;
        }
        
        $prefix = $this->variation >= 0 ? '+' : '';
        return $prefix . number_format($this->variation, 2, ',', '.') . '%';
    }

    /**
     * Verificar se variação é positiva
     */
    public function isVariationPositive(): bool
    {
        return $this->variation !== null && $this->variation >= 0;
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

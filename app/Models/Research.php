<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Research extends Model
{
    use HasFactory;

    protected $table = 'researches';

    protected $fillable = [
        'user_id',
        'title',
        'slug',
        'type',
        'summary',
        'authors',
        'institution',
        'file',
        'external_link',
        'year',
        'doi',
        'keywords',
        'published_at',
    ];

    protected $casts = [
        'published_at' => 'datetime',
        'year' => 'integer',
    ];

    /**
     * Tipos de pesquisa disponíveis
     */
    public static function getTypes(): array
    {
        return [
            'artigo' => 'Artigo',
            'relatorio' => 'Relatório',
            'livro' => 'Livro',
            'dissertacao' => 'Dissertação/Tese',
        ];
    }

    /**
     * Boot do model para gerar slug automático
     */
    protected static function boot()
    {
        parent::boot();

        static::creating(function ($research) {
            if (empty($research->slug)) {
                $research->slug = Str::slug($research->title);
                
                $count = 1;
                $originalSlug = $research->slug;
                while (static::where('slug', $research->slug)->exists()) {
                    $research->slug = $originalSlug . '-' . $count;
                    $count++;
                }
            }
        });

        static::updating(function ($research) {
            if ($research->isDirty('title')) {
                $research->slug = Str::slug($research->title);
                
                $count = 1;
                $originalSlug = $research->slug;
                while (static::where('slug', $research->slug)->where('id', '!=', $research->id)->exists()) {
                    $research->slug = $originalSlug . '-' . $count;
                    $count++;
                }
            }
        });
    }

    /**
     * Relacionamento com usuário (cadastrador)
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Scope para buscar apenas pesquisas publicadas
     */
    public function scopePublished($query)
    {
        return $query->whereNotNull('published_at')
                     ->where('published_at', '<=', now())
                     ->orderBy('published_at', 'desc');
    }

    /**
     * Scope para buscar apenas rascunhos
     */
    public function scopeDraft($query)
    {
        return $query->whereNull('published_at');
    }

    /**
     * Scope para filtrar por tipo
     */
    public function scopeOfType($query, $type)
    {
        return $query->where('type', $type);
    }

    /**
     * Verificar se está publicada
     */
    public function isPublished()
    {
        return $this->published_at !== null && $this->published_at->isPast();
    }

    /**
     * Obter URL do arquivo
     */
    public function getFileUrl()
    {
        if ($this->file) {
            return asset('storage/' . $this->file);
        }
        return null;
    }

    /**
     * Obter nome do tipo formatado
     */
    public function getTypeName()
    {
        return self::getTypes()[$this->type] ?? $this->type;
    }

    /**
     * Formatar data de publicação
     */
    public function getFormattedDate()
    {
        return $this->published_at ? $this->published_at->format('d/m/Y') : null;
    }

    /**
     * Obter array de palavras-chave
     */
    public function getKeywordsArray()
    {
        return $this->keywords ? array_map('trim', explode(',', $this->keywords)) : [];
    }
}

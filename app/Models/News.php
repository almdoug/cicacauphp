<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class News extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'title',
        'slug',
        'image',
        'summary',
        'source',
        'source_url',
        'content',
        'published_at',
    ];

    protected $casts = [
        'published_at' => 'datetime',
    ];

    /**
     * Boot do model para gerar slug automático
     */
    protected static function boot()
    {
        parent::boot();

        static::creating(function ($news) {
            if (empty($news->slug)) {
                $news->slug = Str::slug($news->title);
                
                // Garantir slug único
                $count = 1;
                $originalSlug = $news->slug;
                while (static::where('slug', $news->slug)->exists()) {
                    $news->slug = $originalSlug . '-' . $count;
                    $count++;
                }
            }
        });

        static::updating(function ($news) {
            if ($news->isDirty('title')) {
                $news->slug = Str::slug($news->title);
                
                // Garantir slug único excluindo o próprio registro
                $count = 1;
                $originalSlug = $news->slug;
                while (static::where('slug', $news->slug)->where('id', '!=', $news->id)->exists()) {
                    $news->slug = $originalSlug . '-' . $count;
                    $count++;
                }
            }
        });
    }

    /**
     * Relacionamento com usuário (autor)
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Scope para buscar apenas notícias publicadas
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
     * Verificar se a notícia está publicada
     */
    public function isPublished()
    {
        return $this->published_at !== null && $this->published_at->isPast();
    }

    /**
     * Obter URL da imagem principal
     */
    public function getImageUrl()
    {
        if ($this->image) {
            return asset('storage/' . $this->image);
        }
        return asset('images/default-news.jpg');
    }

    /**
     * Formatar data de publicação
     */
    public function getFormattedDate()
    {
        return $this->published_at ? $this->published_at->format('d/m/Y') : null;
    }

    /**
     * Formatar data completa de publicação
     */
    public function getFormattedDateTime()
    {
        return $this->published_at ? $this->published_at->format('d/m/Y H:i') : null;
    }
}

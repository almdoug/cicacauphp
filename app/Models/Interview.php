<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Interview extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'title',
        'slug',
        'image',
        'summary',
        'interviewee_name',
        'interviewee_role',
        'video_url',
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

        static::creating(function ($item) {
            if (empty($item->slug)) {
                $item->slug = Str::slug($item->title);
                
                // Garantir slug único
                $count = 1;
                $originalSlug = $item->slug;
                while (static::where('slug', $item->slug)->exists()) {
                    $item->slug = $originalSlug . '-' . $count;
                    $count++;
                }
            }
        });

        static::updating(function ($item) {
            if ($item->isDirty('title')) {
                $item->slug = Str::slug($item->title);
                
                // Garantir slug único excluindo o próprio registro
                $count = 1;
                $originalSlug = $item->slug;
                while (static::where('slug', $item->slug)->where('id', '!=', $item->id)->exists()) {
                    $item->slug = $originalSlug . '-' . $count;
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
     * Scope para buscar apenas publicados
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
     * Verificar se está publicado
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
        return null;
    }

    /**
     * Obter data formatada
     */
    public function getFormattedDate()
    {
        return $this->published_at ? $this->published_at->format('d/m/Y') : $this->created_at->format('d/m/Y');
    }

    /**
     * Obter ID do vídeo do YouTube se for um link do YouTube
     */
    public function getYoutubeVideoId()
    {
        if (!$this->video_url) {
            return null;
        }

        $patterns = [
            '/youtube\.com\/watch\?v=([^\&\?\/]+)/',
            '/youtube\.com\/embed\/([^\&\?\/]+)/',
            '/youtu\.be\/([^\&\?\/]+)/',
        ];

        foreach ($patterns as $pattern) {
            if (preg_match($pattern, $this->video_url, $matches)) {
                return $matches[1];
            }
        }

        return null;
    }

    /**
     * Obter URL embed do vídeo
     */
    public function getVideoEmbedUrl()
    {
        $youtubeId = $this->getYoutubeVideoId();
        if ($youtubeId) {
            return "https://www.youtube.com/embed/{$youtubeId}";
        }
        return $this->video_url;
    }
}

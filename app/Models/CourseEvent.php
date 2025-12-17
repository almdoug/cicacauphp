<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class CourseEvent extends Model
{
    use HasFactory;

    protected $table = 'courses_events';

    protected $fillable = [
        'user_id',
        'title',
        'slug',
        'image',
        'summary',
        'type',
        'location',
        'event_date',
        'event_time',
        'registration_link',
        'content',
        'published_at',
    ];

    protected $casts = [
        'published_at' => 'datetime',
        'event_date' => 'date',
        'event_time' => 'datetime:H:i',
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
                     ->orderBy('event_date', 'desc');
    }

    /**
     * Scope para buscar apenas rascunhos
     */
    public function scopeDraft($query)
    {
        return $query->whereNull('published_at');
    }

    /**
     * Scope para buscar por tipo
     */
    public function scopeOfType($query, $type)
    {
        return $query->where('type', $type);
    }

    /**
     * Scope para eventos futuros
     */
    public function scopeUpcoming($query)
    {
        return $query->whereNotNull('event_date')
                     ->where('event_date', '>=', now()->startOfDay())
                     ->orderBy('event_date', 'asc');
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
        if ($this->event_date) {
            return $this->event_date->format('d/m/Y');
        }
        return $this->created_at->format('d/m/Y');
    }

    /**
     * Obter horário formatado
     */
    public function getFormattedTime()
    {
        if ($this->event_time) {
            return \Carbon\Carbon::parse($this->event_time)->format('H:i');
        }
        return null;
    }

    /**
     * Obter label do tipo
     */
    public function getTypeLabel()
    {
        return match($this->type) {
            'curso' => 'Curso',
            'evento' => 'Evento',
            default => 'Evento',
        };
    }

    /**
     * Verificar se é evento futuro
     */
    public function isUpcoming()
    {
        return $this->event_date && $this->event_date->isFuture();
    }
}

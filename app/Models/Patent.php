<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Patent extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'title',
        'slug',
        'patent_number',
        'summary',
        'inventors',
        'applicant',
        'institution',
        'filing_date',
        'grant_date',
        'status',
        'external_link',
        'file',
        'published_at',
    ];

    protected $casts = [
        'published_at' => 'datetime',
        'filing_date' => 'date',
        'grant_date' => 'date',
    ];

    /**
     * Status disponíveis
     */
    public static function getStatuses(): array
    {
        return [
            'pendente' => 'Pendente',
            'concedida' => 'Concedida',
            'expirada' => 'Expirada',
            'abandonada' => 'Abandonada',
        ];
    }

    /**
     * Boot do model para gerar slug automático
     */
    protected static function boot()
    {
        parent::boot();

        static::creating(function ($patent) {
            if (empty($patent->slug)) {
                $patent->slug = Str::slug($patent->title);
                
                $count = 1;
                $originalSlug = $patent->slug;
                while (static::where('slug', $patent->slug)->exists()) {
                    $patent->slug = $originalSlug . '-' . $count;
                    $count++;
                }
            }
        });

        static::updating(function ($patent) {
            if ($patent->isDirty('title')) {
                $patent->slug = Str::slug($patent->title);
                
                $count = 1;
                $originalSlug = $patent->slug;
                while (static::where('slug', $patent->slug)->where('id', '!=', $patent->id)->exists()) {
                    $patent->slug = $originalSlug . '-' . $count;
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
     * Scope para buscar apenas patentes publicadas
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
     * Scope para filtrar por status
     */
    public function scopeOfStatus($query, $status)
    {
        return $query->where('status', $status);
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
     * Obter nome do status formatado
     */
    public function getStatusName()
    {
        return self::getStatuses()[$this->status] ?? $this->status;
    }

    /**
     * Obter cor do badge de status
     */
    public function getStatusColor()
    {
        return match($this->status) {
            'pendente' => 'yellow',
            'concedida' => 'green',
            'expirada' => 'gray',
            'abandonada' => 'red',
            default => 'gray',
        };
    }

    /**
     * Formatar data de publicação
     */
    public function getFormattedDate()
    {
        return $this->published_at ? $this->published_at->format('d/m/Y') : null;
    }

    /**
     * Formatar data de depósito
     */
    public function getFormattedFilingDate()
    {
        return $this->filing_date ? $this->filing_date->format('d/m/Y') : null;
    }

    /**
     * Formatar data de concessão
     */
    public function getFormattedGrantDate()
    {
        return $this->grant_date ? $this->grant_date->format('d/m/Y') : null;
    }
}

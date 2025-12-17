<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class PublicNotice extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'title',
        'slug',
        'summary',
        'content',
        'institution',
        'type',
        'status',
        'opening_date',
        'deadline',
        'budget',
        'external_link',
        'file',
        'published_at',
    ];

    protected $casts = [
        'published_at' => 'datetime',
        'opening_date' => 'date',
        'deadline' => 'date',
        'budget' => 'decimal:2',
    ];

    /**
     * Tipos de edital disponíveis
     */
    public static function getTypes(): array
    {
        return [
            'pesquisa' => 'Pesquisa',
            'extensao' => 'Extensão',
            'bolsa' => 'Bolsa',
            'financiamento' => 'Financiamento',
            'outro' => 'Outro',
        ];
    }

    /**
     * Status disponíveis
     */
    public static function getStatuses(): array
    {
        return [
            'aberto' => 'Aberto',
            'encerrado' => 'Encerrado',
            'em_analise' => 'Em Análise',
            'resultado' => 'Resultado Divulgado',
        ];
    }

    /**
     * Boot do model para gerar slug automático
     */
    protected static function boot()
    {
        parent::boot();

        static::creating(function ($publicNotice) {
            if (empty($publicNotice->slug)) {
                $publicNotice->slug = Str::slug($publicNotice->title);
                
                $count = 1;
                $originalSlug = $publicNotice->slug;
                while (static::where('slug', $publicNotice->slug)->exists()) {
                    $publicNotice->slug = $originalSlug . '-' . $count;
                    $count++;
                }
            }
        });

        static::updating(function ($publicNotice) {
            if ($publicNotice->isDirty('title')) {
                $publicNotice->slug = Str::slug($publicNotice->title);
                
                $count = 1;
                $originalSlug = $publicNotice->slug;
                while (static::where('slug', $publicNotice->slug)->where('id', '!=', $publicNotice->id)->exists()) {
                    $publicNotice->slug = $originalSlug . '-' . $count;
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
     * Scope para buscar apenas editais publicados
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
     * Scope para filtrar por status
     */
    public function scopeOfStatus($query, $status)
    {
        return $query->where('status', $status);
    }

    /**
     * Scope para editais abertos
     */
    public function scopeOpen($query)
    {
        return $query->where('status', 'aberto')
                     ->where(function($q) {
                         $q->whereNull('deadline')
                           ->orWhere('deadline', '>=', now());
                     });
    }

    /**
     * Verificar se está publicado
     */
    public function isPublished()
    {
        return $this->published_at !== null && $this->published_at->isPast();
    }

    /**
     * Verificar se está aberto para inscrições
     */
    public function isOpen()
    {
        if ($this->status !== 'aberto') {
            return false;
        }
        
        if ($this->deadline && $this->deadline->isPast()) {
            return false;
        }
        
        return true;
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
            'aberto' => 'green',
            'encerrado' => 'gray',
            'em_analise' => 'yellow',
            'resultado' => 'blue',
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
     * Formatar deadline
     */
    public function getFormattedDeadline()
    {
        return $this->deadline ? $this->deadline->format('d/m/Y') : null;
    }

    /**
     * Formatar valor do orçamento
     */
    public function getFormattedBudget()
    {
        return $this->budget ? 'R$ ' . number_format($this->budget, 2, ',', '.') : null;
    }

    /**
     * Obter dias restantes para o deadline
     */
    public function getDaysRemaining()
    {
        if (!$this->deadline) {
            return null;
        }
        
        $days = (int) now()->diffInDays($this->deadline, false);
        return $days < 0 ? 0 : $days;
    }
}

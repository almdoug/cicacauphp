<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PageContent extends Model
{
    protected $fillable = [
        'page',
        'section',
        'key',
        'value',
        'type',
    ];

    /**
     * Obter conteúdo específico
     */
    public static function getContent($page, $section, $key, $default = '')
    {
        $content = self::where('page', $page)
            ->where('section', $section)
            ->where('key', $key)
            ->first();

        return $content ? $content->value : $default;
    }

    /**
     * Atualizar ou criar conteúdo
     */
    public static function updateContent($page, $section, $key, $value, $type = 'text')
    {
        return self::updateOrCreate(
            [
                'page' => $page,
                'section' => $section,
                'key' => $key,
            ],
            [
                'value' => $value,
                'type' => $type,
            ]
        );
    }

    /**
     * Obter todos os conteúdos de uma página
     */
    public static function getPageContents($page)
    {
        return self::where('page', $page)->get()->groupBy('section');
    }
}

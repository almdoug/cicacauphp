<?php

namespace App\Http\Controllers;

use App\Models\News;
use Illuminate\Http\Request;

class NewsController extends Controller
{
    /**
     * Exibir lista de notícias publicadas
     */
    public function index()
    {
        $news = News::published()
            ->with('user')
            ->paginate(12);

        return view('noticias', compact('news'));
    }

    /**
     * Exibir notícia individual
     */
    public function show($slug)
    {
        $newsItem = News::where('slug', $slug)
            ->published()
            ->with('user')
            ->firstOrFail();

        // Buscar notícias relacionadas (mesma categoria ou mais recentes)
        $relatedNews = News::published()
            ->where('id', '!=', $newsItem->id)
            ->with('user')
            ->limit(3)
            ->get();

        return view('noticia-single', compact('newsItem', 'relatedNews'));
    }
}

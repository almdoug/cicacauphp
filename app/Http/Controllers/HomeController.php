<?php

namespace App\Http\Controllers;

use App\Models\News;
use App\Models\PageContent;

class HomeController extends Controller
{
    /**
     * Exibir a página inicial
     */
    public function index()
    {
        $contents = PageContent::getPageContents('home');
        
        $news = News::whereNotNull('published_at')
            ->where('published_at', '<=', now())
            ->orderBy('published_at', 'desc')
            ->take(3)
            ->get();
        
        return view('welcome', compact('contents', 'news'));
    }

    /**
     * Exibir a página sobre
     */
    public function sobre()
    {
        $contents = PageContent::getPageContents('sobre');
        return view('sobre', compact('contents'));
    }
}

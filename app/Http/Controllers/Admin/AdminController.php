<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\News;
use App\Models\PageContent;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    /**
     * Exibir dashboard principal
     */
    public function dashboard()
    {
        $pages = [
            'home' => 'Página Inicial',
            'sobre' => 'Sobre',
        ];

        $newsCount = News::count();
        $publishedNewsCount = News::published()->count();
        $draftNewsCount = News::draft()->count();

        return view('admin.dashboard', compact('pages', 'newsCount', 'publishedNewsCount', 'draftNewsCount'));
    }

    /**
     * Listar páginas disponíveis
     */
    public function pages()
    {
        $pages = [
            'home' => 'Página Inicial',
            'sobre' => 'Sobre',
        ];

        return view('admin.pages.index', compact('pages'));
    }
}

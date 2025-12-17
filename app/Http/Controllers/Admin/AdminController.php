<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\News;
use App\Models\PageContent;
use App\Models\Research;
use App\Models\Patent;
use App\Models\PublicNotice;
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

        // News stats
        $newsCount = News::count();
        $publishedNewsCount = News::published()->count();
        $draftNewsCount = News::draft()->count();

        // Research stats (Pesquisa)
        $researchCount = Research::count();
        $publishedResearchCount = Research::published()->count();

        // Patents stats (Patentes)
        $patentCount = Patent::count();
        $publishedPatentCount = Patent::published()->count();

        // Public Notices stats (Editais)
        $publicNoticeCount = PublicNotice::count();
        $openPublicNoticeCount = PublicNotice::published()->where('status', 'aberto')->count();

        return view('admin.dashboard', compact(
            'pages', 
            'newsCount', 
            'publishedNewsCount', 
            'draftNewsCount',
            'researchCount',
            'publishedResearchCount',
            'patentCount',
            'publishedPatentCount',
            'publicNoticeCount',
            'openPublicNoticeCount'
        ));
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

<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
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
        ];

        return view('admin.dashboard', compact('pages'));
    }

    /**
     * Listar páginas disponíveis
     */
    public function pages()
    {
        $pages = PageContent::select('page')->distinct()->get();
        return view('admin.pages', compact('pages'));
    }
}

<?php

namespace App\Http\Controllers;

use App\Models\Research;
use Illuminate\Http\Request;

class ResearchController extends Controller
{
    /**
     * Exibir lista de pesquisas publicadas
     */
    public function index(Request $request)
    {
        $query = Research::published()->with('user');

        // Filtro por tipo
        if ($request->filled('tipo')) {
            $query->ofType($request->tipo);
        }

        // Filtro por ano
        if ($request->filled('ano')) {
            $query->where('year', $request->ano);
        }

        // Busca por termo
        if ($request->filled('busca')) {
            $search = $request->busca;
            $query->where(function($q) use ($search) {
                $q->where('title', 'like', "%{$search}%")
                  ->orWhere('authors', 'like', "%{$search}%")
                  ->orWhere('summary', 'like', "%{$search}%")
                  ->orWhere('keywords', 'like', "%{$search}%");
            });
        }

        $researches = $query->paginate(12)->withQueryString();
        
        // Anos disponíveis para filtro
        $years = Research::published()
            ->whereNotNull('year')
            ->distinct()
            ->orderBy('year', 'desc')
            ->pluck('year');

        $types = Research::getTypes();

        return view('pesquisa', compact('researches', 'types', 'years'));
    }

    /**
     * Exibir pesquisa individual
     */
    public function show($slug)
    {
        $research = Research::where('slug', $slug)
            ->published()
            ->with('user')
            ->firstOrFail();

        // Pesquisas relacionadas (mesmo tipo)
        $relatedResearches = Research::published()
            ->where('id', '!=', $research->id)
            ->where('type', $research->type)
            ->with('user')
            ->limit(3)
            ->get();

        return view('pesquisa-single', compact('research', 'relatedResearches'));
    }
}

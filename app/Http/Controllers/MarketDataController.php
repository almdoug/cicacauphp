<?php

namespace App\Http\Controllers;

use App\Models\MarketData;
use Illuminate\Http\Request;

class MarketDataController extends Controller
{
    /**
     * Listar dados de mercado
     */
    public function index(Request $request)
    {
        $query = MarketData::published()
                           ->orderBy('published_at', 'desc');

        // Filtro por categoria
        if ($request->filled('category')) {
            $query->ofCategory($request->category);
        }

        // Filtro por escopo (nacional/internacional)
        if ($request->filled('scope')) {
            $query->ofScope($request->scope);
        }

        // Filtro por região
        if ($request->filled('region')) {
            $query->where('region', $request->region);
        }

        // Filtro por período
        if ($request->filled('period')) {
            $query->where('period', $request->period);
        }

        // Busca por texto
        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function ($q) use ($search) {
                $q->where('title', 'like', "%{$search}%")
                  ->orWhere('summary', 'like', "%{$search}%")
                  ->orWhere('source', 'like', "%{$search}%");
            });
        }

        $marketData = $query->paginate(12)->withQueryString();
        
        $categories = MarketData::CATEGORIES;
        $scopes = MarketData::SCOPES;
        $regions = MarketData::getUniqueRegions();
        $periods = MarketData::getUniquePeriods();

        return view('mercado', compact('marketData', 'categories', 'scopes', 'regions', 'periods'));
    }

    /**
     * Exibir um dado de mercado específico
     */
    public function show($slug)
    {
        $data = MarketData::where('slug', $slug)
                          ->published()
                          ->firstOrFail();

        // Itens relacionados (mesma categoria)
        $related = MarketData::published()
                             ->where('id', '!=', $data->id)
                             ->where('category', $data->category)
                             ->orderBy('published_at', 'desc')
                             ->limit(3)
                             ->get();

        return view('mercado-single', compact('data', 'related'));
    }
}

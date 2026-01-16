<?php

namespace App\Http\Controllers;

use App\Models\MarketData;
use App\Exports\MarketDataDataExport;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;

class MarketDataController extends Controller
{
    /**
     * Listar dados de mercado
     */
    public function index(Request $request)
    {
        $query = MarketData::whereNotNull('published_at')
                           ->where('published_at', '<=', now())
                           ->orderBy('updated_at_data', 'desc');

        // Filtro por categoria (Desativado temporariamente devido a refatoração)
        /*
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
        */

        // Busca por texto
        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function ($q) use ($search) {
                $q->where('title', 'like', "%{$search}%")
                  ->orWhere('source', 'like', "%{$search}%");
            });
        }

        $marketData = $query->paginate(12)->withQueryString();
        
        // Passando arrays vazios para evitar erro na view enquanto os filtros são refeitos
        $categories = []; // MarketData::CATEGORIES;
        $scopes = []; // MarketData::SCOPES;
        $regions = []; // MarketData::getUniqueRegions();
        $periods = []; // MarketData::getUniquePeriods();

        return view('mercado', compact('marketData', 'categories', 'scopes', 'regions', 'periods'));
    }

    /**
     * Exibir um dado de mercado específico
     */
    public function show($slug)
    {
        $data = MarketData::whereNotNull('published_at')
                          ->where('published_at', '<=', now())
                          ->where('slug', $slug)
                          ->firstOrFail();

        // Itens relacionados (mesma categoria)
        $related = MarketData::whereNotNull('published_at')
                             ->where('published_at', '<=', now())
                             ->where('id', '!=', $data->id)
                             // ->where('category', $data->category)
                             ->orderBy('updated_at_data', 'desc')
                             ->limit(3)
                             ->get();

        return view('mercado-single', compact('data', 'related'));
    }

    /**
     * Exportar dados para Excel
     */
    public function export($slug)
    {
        $data = MarketData::where('slug', $slug)
                          ->firstOrFail();
        $data->load('dataSeries');
        
        $filename = 'mercado_' . str_replace(' ', '_', strtolower($data->title)) . '_' . now()->format('Y-m-d') . '.xlsx';
        
        return Excel::download(new MarketDataDataExport($data), $filename);
    }
}

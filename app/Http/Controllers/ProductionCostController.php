<?php

namespace App\Http\Controllers;

use App\Models\ProductionCost;
use App\Exports\ProductionCostDataExport;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;

class ProductionCostController extends Controller
{
    /**
     * Listar custos de produção
     */
    public function index(Request $request)
    {
        $query = ProductionCost::whereNotNull('published_at')
                               ->where('published_at', '<=', now())
                               ->orderBy('created_at', 'desc');

        // Filtro por país
        if ($request->filled('country')) {
            $query->where('country', $request->country);
        }

        // Busca por texto
        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function ($q) use ($search) {
                $q->where('title', 'like', "%{$search}%")
                  ->orWhere('comment', 'like', "%{$search}%")
                  ->orWhere('source', 'like', "%{$search}%");
            });
        }

        $costs = $query->paginate(12)->withQueryString();

        return view('custos-producao', compact('costs'));
    }

    /**
     * Exibir um custo de produção específico
     */
    public function show($slug)
    {
        $cost = ProductionCost::whereNotNull('published_at')
                              ->where('published_at', '<=', now())
                              ->where('slug', $slug)
                              ->firstOrFail();

        // Itens relacionados (mesmo país)
        $related = ProductionCost::whereNotNull('published_at')
                                 ->where('published_at', '<=', now())
                                 ->where('id', '!=', $cost->id)
                                 ->where('country', $cost->country)
                                 ->orderBy('created_at', 'desc')
                                 ->limit(3)
                                 ->get();

        return view('custo-producao-single', compact('cost', 'related'));
    }

    /**
     * Exportar dados para Excel
     */
    public function export($slug)
    {
        $cost = ProductionCost::where('slug', $slug)->firstOrFail();
        $cost->load('dataSeries');
        
        $filename = 'custo_producao_' . str_replace(' ', '_', strtolower($cost->title)) . '_' . now()->format('Y-m-d') . '.xlsx';
        
        return Excel::download(new ProductionCostDataExport($cost), $filename);
    }
}

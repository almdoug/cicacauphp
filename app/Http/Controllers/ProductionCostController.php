<?php

namespace App\Http\Controllers;

use App\Models\ProductionCost;
use Illuminate\Http\Request;

class ProductionCostController extends Controller
{
    /**
     * Listar custos de produção
     */
    public function index(Request $request)
    {
        $query = ProductionCost::published()
                               ->orderBy('published_at', 'desc');

        // Filtro por tipo
        if ($request->filled('type')) {
            $query->ofType($request->type);
        }

        // Filtro por região
        if ($request->filled('region')) {
            $query->ofRegion($request->region);
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

        $costs = $query->paginate(12)->withQueryString();
        
        $types = ProductionCost::TYPES;
        $regions = ProductionCost::getUniqueRegions();
        $periods = ProductionCost::getUniquePeriods();

        return view('custos-producao', compact('costs', 'types', 'regions', 'periods'));
    }

    /**
     * Exibir um custo de produção específico
     */
    public function show($slug)
    {
        $cost = ProductionCost::where('slug', $slug)
                              ->published()
                              ->firstOrFail();

        // Itens relacionados (mesmo tipo)
        $related = ProductionCost::published()
                                 ->where('id', '!=', $cost->id)
                                 ->where('type', $cost->type)
                                 ->orderBy('published_at', 'desc')
                                 ->limit(3)
                                 ->get();

        return view('custo-producao-single', compact('cost', 'related'));
    }
}

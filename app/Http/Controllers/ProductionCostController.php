<?php

namespace App\Http\Controllers;

use App\Models\ProductionCost;
use App\Exports\ProductionCostDataExport;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
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
    public function export($slug, $type = 'pdf')
    {
        $cost = ProductionCost::where('slug', $slug)->firstOrFail();
        
        // Determinar qual arquivo baixar
        if ($type === 'spreadsheet' && $cost->file_spreadsheet_path) {
            if (Storage::disk('public')->exists($cost->file_spreadsheet_path)) {
                $filePath = Storage::disk('public')->path($cost->file_spreadsheet_path);
                $fileName = $cost->file_spreadsheet_name ?? basename($cost->file_spreadsheet_path);
                return response()->download($filePath, $fileName);
            }
        } elseif ($cost->file_pdf_path) {
            if (Storage::disk('public')->exists($cost->file_pdf_path)) {
                $filePath = Storage::disk('public')->path($cost->file_pdf_path);
                $fileName = $cost->file_pdf_name ?? basename($cost->file_pdf_path);
                return response()->download($filePath, $fileName);
            }
        }
        
        // Se não houver arquivo, retornar erro 404
        abort(404, 'Arquivo não encontrado.');
    }
}

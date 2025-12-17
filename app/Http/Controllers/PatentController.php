<?php

namespace App\Http\Controllers;

use App\Models\Patent;
use Illuminate\Http\Request;

class PatentController extends Controller
{
    /**
     * Exibir lista de patentes publicadas
     */
    public function index(Request $request)
    {
        $query = Patent::published()->with('user');

        // Filtro por status
        if ($request->filled('status')) {
            $query->ofStatus($request->status);
        }

        // Busca por termo
        if ($request->filled('busca')) {
            $search = $request->busca;
            $query->where(function($q) use ($search) {
                $q->where('title', 'like', "%{$search}%")
                  ->orWhere('inventors', 'like', "%{$search}%")
                  ->orWhere('summary', 'like', "%{$search}%")
                  ->orWhere('patent_number', 'like', "%{$search}%");
            });
        }

        $patents = $query->paginate(12)->withQueryString();
        $statuses = Patent::getStatuses();

        return view('patentes', compact('patents', 'statuses'));
    }

    /**
     * Exibir patente individual
     */
    public function show($slug)
    {
        $patent = Patent::where('slug', $slug)
            ->published()
            ->with('user')
            ->firstOrFail();

        // Patentes relacionadas
        $relatedPatents = Patent::published()
            ->where('id', '!=', $patent->id)
            ->with('user')
            ->limit(3)
            ->get();

        return view('patente-single', compact('patent', 'relatedPatents'));
    }
}

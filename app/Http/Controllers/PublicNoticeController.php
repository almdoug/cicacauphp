<?php

namespace App\Http\Controllers;

use App\Models\PublicNotice;
use Illuminate\Http\Request;

class PublicNoticeController extends Controller
{
    /**
     * Exibir lista de editais publicados
     */
    public function index(Request $request)
    {
        $query = PublicNotice::published()->with('user');

        // Filtro por tipo
        if ($request->filled('tipo')) {
            $query->ofType($request->tipo);
        }

        // Filtro por status
        if ($request->filled('status')) {
            $query->ofStatus($request->status);
        }

        // Filtro só editais abertos
        if ($request->filled('abertos') && $request->abertos == '1') {
            $query->open();
        }

        // Busca por termo
        if ($request->filled('busca')) {
            $search = $request->busca;
            $query->where(function($q) use ($search) {
                $q->where('title', 'like', "%{$search}%")
                  ->orWhere('institution', 'like', "%{$search}%")
                  ->orWhere('summary', 'like', "%{$search}%");
            });
        }

        $publicNotices = $query->paginate(12)->withQueryString();
        
        $types = PublicNotice::getTypes();
        $statuses = PublicNotice::getStatuses();

        return view('editais', compact('publicNotices', 'types', 'statuses'));
    }

    /**
     * Exibir edital individual
     */
    public function show($slug)
    {
        $publicNotice = PublicNotice::where('slug', $slug)
            ->published()
            ->with('user')
            ->firstOrFail();

        // Editais relacionados (mesmo tipo ou instituição)
        $relatedNotices = PublicNotice::published()
            ->where('id', '!=', $publicNotice->id)
            ->where(function($q) use ($publicNotice) {
                $q->where('type', $publicNotice->type)
                  ->orWhere('institution', $publicNotice->institution);
            })
            ->with('user')
            ->limit(3)
            ->get();

        return view('edital-single', compact('publicNotice', 'relatedNotices'));
    }
}

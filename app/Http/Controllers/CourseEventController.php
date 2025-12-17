<?php

namespace App\Http\Controllers;

use App\Models\CourseEvent;
use Illuminate\Http\Request;

class CourseEventController extends Controller
{
    /**
     * Exibir lista de cursos e eventos publicados
     */
    public function index()
    {
        $items = CourseEvent::published()
            ->with('user')
            ->paginate(12);

        return view('cursos-eventos', compact('items'));
    }

    /**
     * Exibir curso/evento individual
     */
    public function show($slug)
    {
        $item = CourseEvent::where('slug', $slug)
            ->published()
            ->with('user')
            ->firstOrFail();

        // Buscar itens relacionados
        $relatedItems = CourseEvent::published()
            ->where('id', '!=', $item->id)
            ->with('user')
            ->limit(3)
            ->get();

        return view('curso-evento-single', compact('item', 'relatedItems'));
    }
}

<?php

namespace App\Http\Controllers;

use App\Models\Interview;
use Illuminate\Http\Request;

class InterviewController extends Controller
{
    /**
     * Exibir lista de entrevistas publicadas
     */
    public function index()
    {
        $interviews = Interview::published()
            ->with('user')
            ->paginate(12);

        return view('entrevistas', compact('interviews'));
    }

    /**
     * Exibir entrevista individual
     */
    public function show($slug)
    {
        $interview = Interview::where('slug', $slug)
            ->published()
            ->with('user')
            ->firstOrFail();

        // Buscar entrevistas relacionadas
        $relatedInterviews = Interview::published()
            ->where('id', '!=', $interview->id)
            ->with('user')
            ->limit(3)
            ->get();

        return view('entrevista-single', compact('interview', 'relatedInterviews'));
    }
}

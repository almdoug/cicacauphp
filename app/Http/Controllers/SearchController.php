<?php

namespace App\Http\Controllers;

use App\Models\News;
use App\Models\Research;
use App\Models\Patent;
use App\Models\PublicNotice;
use App\Models\ProductionCost;
use App\Models\MarketData;
use App\Models\CourseEvent;
use App\Models\Interview;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;

class SearchController extends Controller
{
    public function search(Request $request)
    {
        $query = $request->input('q', '');
        
        // Validar tamanho mínimo e máximo
        if (strlen($query) < 3) {
            return response()->json(['results' => []]);
        }
        
        if (strlen($query) > 100) {
            return response()->json([
                'error' => 'Consulta muito longa. Máximo de 100 caracteres.'
            ], 400);
        }

        // Cache de 5 minutos para cada busca
        $cacheKey = 'search:' . md5(strtolower(trim($query)));
        
        $results = Cache::remember($cacheKey, 300, function() use ($query) {
            return $this->performSearch($query);
        });

        return response()->json(['results' => $results]);
    }

    private function performSearch($query)
    {
        $results = [];
        
        // Sanitizar query para evitar problemas com caracteres especiais
        $searchQuery = '%' . str_replace(['%', '_'], ['\%', '\_'], $query) . '%';

        // Buscar em Notícias
        $news = News::whereNotNull('published_at')
            ->where('published_at', '<=', now())
            ->where(function($q) use ($searchQuery) {
                $q->where('title', 'LIKE', $searchQuery)
                  ->orWhere('summary', 'LIKE', $searchQuery);
            })
            ->select('id', 'title', 'summary', 'slug')
            ->take(3)
            ->get();

        foreach ($news as $item) {
            $results[] = [
                'id' => 'news-' . $item->id,
                'title' => $item->title,
                'description' => $item->summary,
                'category' => 'Notícias',
                'url' => route('noticias.show', $item->slug),
            ];
        }

        // Buscar em Pesquisas
        $researches = Research::whereNotNull('published_at')
            ->where('published_at', '<=', now())
            ->where(function($q) use ($searchQuery) {
                $q->where('title', 'LIKE', $searchQuery)
                  ->orWhere('summary', 'LIKE', $searchQuery);
            })
            ->select('id', 'title', 'summary', 'slug')
            ->take(3)
            ->get();

        foreach ($researches as $item) {
            $results[] = [
                'id' => 'research-' . $item->id,
                'title' => $item->title,
                'description' => $item->summary,
                'category' => 'Pesquisas',
                'url' => route('pesquisa.show', $item->slug),
            ];
        }

        // Buscar em Patentes
        $patents = Patent::whereNotNull('published_at')
            ->where('published_at', '<=', now())
            ->where(function($q) use ($searchQuery) {
                $q->where('title', 'LIKE', $searchQuery)
                  ->orWhere('summary', 'LIKE', $searchQuery);
            })
            ->select('id', 'title', 'summary', 'slug')
            ->take(2)
            ->get();

        foreach ($patents as $item) {
            $results[] = [
                'id' => 'patent-' . $item->id,
                'title' => $item->title,
                'description' => $item->summary,
                'category' => 'Patentes',
                'url' => route('patentes.show', $item->slug),
            ];
        }

        // Buscar em Editais
        $notices = PublicNotice::whereNotNull('published_at')
            ->where('published_at', '<=', now())
            ->where(function($q) use ($searchQuery) {
                $q->where('title', 'LIKE', $searchQuery)
                  ->orWhere('summary', 'LIKE', $searchQuery);
            })
            ->select('id', 'title', 'summary', 'slug')
            ->take(2)
            ->get();

        foreach ($notices as $item) {
            $results[] = [
                'id' => 'notice-' . $item->id,
                'title' => $item->title,
                'description' => $item->summary,
                'category' => 'Editais',
                'url' => route('editais.show', $item->slug),
            ];
        }

        // Buscar em Cursos e Eventos
        $events = CourseEvent::whereNotNull('published_at')
            ->where('published_at', '<=', now())
            ->where(function($q) use ($searchQuery) {
                $q->where('title', 'LIKE', $searchQuery)
                  ->orWhere('summary', 'LIKE', $searchQuery);
            })
            ->select('id', 'title', 'summary', 'slug')
            ->take(2)
            ->get();

        foreach ($events as $item) {
            $results[] = [
                'id' => 'event-' . $item->id,
                'title' => $item->title,
                'description' => $item->summary,
                'category' => 'Cursos e Eventos',
                'url' => route('cursos-eventos.show', $item->slug),
            ];
        }

        // Buscar em Entrevistas
        $interviews = Interview::whereNotNull('published_at')
            ->where('published_at', '<=', now())
            ->where(function($q) use ($searchQuery) {
                $q->where('title', 'LIKE', $searchQuery)
                  ->orWhere('summary', 'LIKE', $searchQuery);
            })
            ->select('id', 'title', 'summary', 'slug')
            ->take(2)
            ->get();

        foreach ($interviews as $item) {
            $results[] = [
                'id' => 'interview-' . $item->id,
                'title' => $item->title,
                'description' => $item->summary,
                'category' => 'Entrevistas',
                'url' => route('entrevistas.show', $item->slug),
            ];
        }

        // Buscar em Custos de Produção
        $costs = ProductionCost::whereNotNull('published_at')
            ->where('published_at', '<=', now())
            ->where(function($q) use ($searchQuery) {
                $q->where('title', 'LIKE', $searchQuery)
                  ->orWhere('comment', 'LIKE', $searchQuery);
            })
            ->select('id', 'title', 'comment', 'source', 'slug')
            ->take(2)
            ->get();

        foreach ($costs as $item) {
            $results[] = [
                'id' => 'cost-' . $item->id,
                'title' => $item->title,
                'description' => $item->comment ?? 'Custos de produção - ' . $item->source,
                'category' => 'Custos de Produção',
                'url' => route('custos.show', $item->slug),
            ];
        }

        // Buscar em Mercado Nacional e Internacional
        $markets = MarketData::whereNotNull('published_at')
            ->where('published_at', '<=', now())
            ->where(function($q) use ($searchQuery) {
                $q->where('title', 'LIKE', $searchQuery)
                  ->orWhere('comment', 'LIKE', $searchQuery);
            })
            ->select('id', 'title', 'comment', 'source', 'slug')
            ->take(2)
            ->get();

        foreach ($markets as $item) {
            $results[] = [
                'id' => 'market-' . $item->id,
                'title' => $item->title,
                'description' => $item->comment ?? 'Dados de mercado - ' . $item->source,
                'category' => 'Mercado Nacional e Internacional',
                'url' => route('mercado.show', $item->slug),
            ];
        }

        // Limitar resultados totais
        $results = array_slice($results, 0, 10);

        return $results;
    }
}

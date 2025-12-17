<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\MarketData;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class MarketDataController extends Controller
{
    /**
     * Listar dados de mercado
     */
    public function index()
    {
        $marketData = MarketData::with('user')
                                ->orderBy('created_at', 'desc')
                                ->paginate(15);
        
        return view('admin.market-data.index', compact('marketData'));
    }

    /**
     * Formulário de criação
     */
    public function create()
    {
        $categories = MarketData::CATEGORIES;
        $scopes = MarketData::SCOPES;
        return view('admin.market-data.create', compact('categories', 'scopes'));
    }

    /**
     * Salvar novo dado de mercado
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'summary' => 'required|string|max:1000',
            'content' => 'nullable|string',
            'category' => 'required|in:' . implode(',', array_keys(MarketData::CATEGORIES)),
            'scope' => 'required|in:' . implode(',', array_keys(MarketData::SCOPES)),
            'region' => 'nullable|string|max:100',
            'period' => 'nullable|string|max:50',
            'value' => 'nullable|numeric',
            'unit' => 'nullable|string|max:50',
            'variation' => 'nullable|numeric',
            'source' => 'nullable|string|max:255',
            'file' => 'nullable|file|mimes:pdf,xlsx,xls,csv,png,jpg,jpeg|max:10240',
            'external_link' => 'nullable|url|max:255',
            'published_at' => 'nullable|date',
        ]);

        $validated['user_id'] = Auth::id();

        // Upload de arquivo
        if ($request->hasFile('file')) {
            $validated['file'] = $request->file('file')->store('market-data', 'public');
        }

        // Publicar agora
        if ($request->has('publish_now')) {
            $validated['published_at'] = now();
        }

        MarketData::create($validated);

        return redirect()
            ->route('admin.market-data.index')
            ->with('success', 'Dado de mercado cadastrado com sucesso!');
    }

    /**
     * Formulário de edição
     */
    public function edit(MarketData $marketData)
    {
        $categories = MarketData::CATEGORIES;
        $scopes = MarketData::SCOPES;
        return view('admin.market-data.edit', compact('marketData', 'categories', 'scopes'));
    }

    /**
     * Atualizar dado de mercado
     */
    public function update(Request $request, MarketData $marketData)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'summary' => 'required|string|max:1000',
            'content' => 'nullable|string',
            'category' => 'required|in:' . implode(',', array_keys(MarketData::CATEGORIES)),
            'scope' => 'required|in:' . implode(',', array_keys(MarketData::SCOPES)),
            'region' => 'nullable|string|max:100',
            'period' => 'nullable|string|max:50',
            'value' => 'nullable|numeric',
            'unit' => 'nullable|string|max:50',
            'variation' => 'nullable|numeric',
            'source' => 'nullable|string|max:255',
            'file' => 'nullable|file|mimes:pdf,xlsx,xls,csv,png,jpg,jpeg|max:10240',
            'external_link' => 'nullable|url|max:255',
            'published_at' => 'nullable|date',
        ]);

        // Upload de arquivo
        if ($request->hasFile('file')) {
            // Remover arquivo anterior
            if ($marketData->file) {
                Storage::disk('public')->delete($marketData->file);
            }
            $validated['file'] = $request->file('file')->store('market-data', 'public');
        }

        // Publicar agora
        if ($request->has('publish_now') && !$marketData->isPublished()) {
            $validated['published_at'] = now();
        }

        $marketData->update($validated);

        return redirect()
            ->route('admin.market-data.index')
            ->with('success', 'Dado de mercado atualizado com sucesso!');
    }

    /**
     * Deletar dado de mercado
     */
    public function destroy(MarketData $marketData)
    {
        // Remover arquivo
        if ($marketData->file) {
            Storage::disk('public')->delete($marketData->file);
        }

        $marketData->delete();

        return redirect()
            ->route('admin.market-data.index')
            ->with('success', 'Dado de mercado deletado com sucesso!');
    }

    /**
     * Toggle publicação
     */
    public function togglePublish(MarketData $marketData)
    {
        if ($marketData->isPublished()) {
            $marketData->update(['published_at' => null]);
            $message = 'Dado de mercado despublicado com sucesso!';
        } else {
            $marketData->update(['published_at' => now()]);
            $message = 'Dado de mercado publicado com sucesso!';
        }

        return redirect()->back()->with('success', $message);
    }
}

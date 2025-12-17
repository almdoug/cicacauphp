<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ProductionCost;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class ProductionCostController extends Controller
{
    /**
     * Listar custos de produção
     */
    public function index()
    {
        $costs = ProductionCost::with('user')
                               ->orderBy('created_at', 'desc')
                               ->paginate(15);
        
        return view('admin.production-costs.index', compact('costs'));
    }

    /**
     * Formulário de criação
     */
    public function create()
    {
        $types = ProductionCost::TYPES;
        return view('admin.production-costs.create', compact('types'));
    }

    /**
     * Salvar novo custo de produção
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'summary' => 'required|string|max:1000',
            'content' => 'nullable|string',
            'type' => 'required|in:' . implode(',', array_keys(ProductionCost::TYPES)),
            'region' => 'nullable|string|max:100',
            'period' => 'nullable|string|max:50',
            'value' => 'nullable|numeric|min:0',
            'unit' => 'nullable|string|max:50',
            'source' => 'nullable|string|max:255',
            'file' => 'nullable|file|mimes:pdf,xlsx,xls,csv|max:10240',
            'external_link' => 'nullable|url|max:255',
            'published_at' => 'nullable|date',
        ]);

        $validated['user_id'] = Auth::id();

        // Upload de arquivo
        if ($request->hasFile('file')) {
            $validated['file'] = $request->file('file')->store('production-costs', 'public');
        }

        // Publicar agora
        if ($request->has('publish_now')) {
            $validated['published_at'] = now();
        }

        ProductionCost::create($validated);

        return redirect()
            ->route('admin.production-costs.index')
            ->with('success', 'Custo de produção cadastrado com sucesso!');
    }

    /**
     * Formulário de edição
     */
    public function edit(ProductionCost $productionCost)
    {
        $types = ProductionCost::TYPES;
        return view('admin.production-costs.edit', compact('productionCost', 'types'));
    }

    /**
     * Atualizar custo de produção
     */
    public function update(Request $request, ProductionCost $productionCost)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'summary' => 'required|string|max:1000',
            'content' => 'nullable|string',
            'type' => 'required|in:' . implode(',', array_keys(ProductionCost::TYPES)),
            'region' => 'nullable|string|max:100',
            'period' => 'nullable|string|max:50',
            'value' => 'nullable|numeric|min:0',
            'unit' => 'nullable|string|max:50',
            'source' => 'nullable|string|max:255',
            'file' => 'nullable|file|mimes:pdf,xlsx,xls,csv|max:10240',
            'external_link' => 'nullable|url|max:255',
            'published_at' => 'nullable|date',
        ]);

        // Upload de arquivo
        if ($request->hasFile('file')) {
            // Remover arquivo anterior
            if ($productionCost->file) {
                Storage::disk('public')->delete($productionCost->file);
            }
            $validated['file'] = $request->file('file')->store('production-costs', 'public');
        }

        // Publicar agora
        if ($request->has('publish_now') && !$productionCost->isPublished()) {
            $validated['published_at'] = now();
        }

        $productionCost->update($validated);

        return redirect()
            ->route('admin.production-costs.index')
            ->with('success', 'Custo de produção atualizado com sucesso!');
    }

    /**
     * Deletar custo de produção
     */
    public function destroy(ProductionCost $productionCost)
    {
        // Remover arquivo
        if ($productionCost->file) {
            Storage::disk('public')->delete($productionCost->file);
        }

        $productionCost->delete();

        return redirect()
            ->route('admin.production-costs.index')
            ->with('success', 'Custo de produção deletado com sucesso!');
    }

    /**
     * Toggle publicação
     */
    public function togglePublish(ProductionCost $productionCost)
    {
        if ($productionCost->isPublished()) {
            $productionCost->update(['published_at' => null]);
            $message = 'Custo de produção despublicado com sucesso!';
        } else {
            $productionCost->update(['published_at' => now()]);
            $message = 'Custo de produção publicado com sucesso!';
        }

        return redirect()->back()->with('success', $message);
    }
}

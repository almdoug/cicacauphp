<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Research;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class ResearchController extends Controller
{
    /**
     * Exibir lista de pesquisas no admin
     */
    public function index()
    {
        $researches = Research::with('user')
            ->orderBy('created_at', 'desc')
            ->paginate(15);

        return view('admin.researches.index', compact('researches'));
    }

    /**
     * Mostrar formulário de criação
     */
    public function create()
    {
        $types = Research::getTypes();
        return view('admin.researches.create', compact('types'));
    }

    /**
     * Armazenar nova pesquisa
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'type' => 'required|in:artigo,relatorio,livro,dissertacao',
            'summary' => 'required|string|max:1000',
            'authors' => 'required|string|max:500',
            'institution' => 'nullable|string|max:255',
            'external_link' => 'nullable|url|max:500',
            'year' => 'nullable|integer|min:1900|max:' . (date('Y') + 1),
            'doi' => 'nullable|string|max:255',
            'keywords' => 'nullable|string|max:500',
            'file' => 'nullable|mimes:pdf|max:10240',
            'published_at' => 'nullable|date',
        ]);

        $validated['user_id'] = Auth::id();

        // Upload do arquivo
        if ($request->hasFile('file')) {
            $validated['file'] = $request->file('file')->store('researches', 'public');
        }

        // Publicar agora
        if (!isset($validated['published_at']) && $request->has('publish_now')) {
            $validated['published_at'] = now();
        }

        Research::create($validated);

        return redirect()
            ->route('admin.researches.index')
            ->with('success', 'Pesquisa criada com sucesso!');
    }

    /**
     * Mostrar formulário de edição
     */
    public function edit(Research $research)
    {
        $types = Research::getTypes();
        return view('admin.researches.edit', compact('research', 'types'));
    }

    /**
     * Atualizar pesquisa
     */
    public function update(Request $request, Research $research)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'type' => 'required|in:artigo,relatorio,livro,dissertacao',
            'summary' => 'required|string|max:1000',
            'authors' => 'required|string|max:500',
            'institution' => 'nullable|string|max:255',
            'external_link' => 'nullable|url|max:500',
            'year' => 'nullable|integer|min:1900|max:' . (date('Y') + 1),
            'doi' => 'nullable|string|max:255',
            'keywords' => 'nullable|string|max:500',
            'file' => 'nullable|mimes:pdf|max:10240',
            'published_at' => 'nullable|date',
        ]);

        // Upload do novo arquivo
        if ($request->hasFile('file')) {
            if ($research->file) {
                Storage::disk('public')->delete($research->file);
            }
            $validated['file'] = $request->file('file')->store('researches', 'public');
        }

        // Publicar agora
        if (!isset($validated['published_at']) && $request->has('publish_now')) {
            $validated['published_at'] = now();
        }

        $research->update($validated);

        return redirect()
            ->route('admin.researches.index')
            ->with('success', 'Pesquisa atualizada com sucesso!');
    }

    /**
     * Deletar pesquisa
     */
    public function destroy(Research $research)
    {
        if ($research->file) {
            Storage::disk('public')->delete($research->file);
        }

        $research->delete();

        return redirect()
            ->route('admin.researches.index')
            ->with('success', 'Pesquisa deletada com sucesso!');
    }

    /**
     * Publicar/despublicar pesquisa
     */
    public function togglePublish(Research $research)
    {
        if ($research->published_at) {
            $research->update(['published_at' => null]);
            $message = 'Pesquisa despublicada com sucesso!';
        } else {
            $research->update(['published_at' => now()]);
            $message = 'Pesquisa publicada com sucesso!';
        }

        return redirect()
            ->route('admin.researches.index')
            ->with('success', $message);
    }
}

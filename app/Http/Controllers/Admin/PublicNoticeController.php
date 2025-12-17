<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\PublicNotice;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class PublicNoticeController extends Controller
{
    /**
     * Exibir lista de editais no admin
     */
    public function index()
    {
        $publicNotices = PublicNotice::with('user')
            ->orderBy('created_at', 'desc')
            ->paginate(15);

        return view('admin.public-notices.index', compact('publicNotices'));
    }

    /**
     * Mostrar formulário de criação
     */
    public function create()
    {
        $types = PublicNotice::getTypes();
        $statuses = PublicNotice::getStatuses();
        return view('admin.public-notices.create', compact('types', 'statuses'));
    }

    /**
     * Armazenar novo edital
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'summary' => 'required|string|max:1000',
            'content' => 'nullable|string',
            'institution' => 'required|string|max:255',
            'type' => 'required|in:pesquisa,extensao,bolsa,financiamento,outro',
            'status' => 'required|in:aberto,encerrado,em_analise,resultado',
            'opening_date' => 'nullable|date',
            'deadline' => 'nullable|date',
            'budget' => 'nullable|numeric|min:0',
            'external_link' => 'nullable|url|max:500',
            'file' => 'nullable|mimes:pdf|max:10240',
            'published_at' => 'nullable|date',
        ]);

        $validated['user_id'] = Auth::id();

        // Upload do arquivo
        if ($request->hasFile('file')) {
            $validated['file'] = $request->file('file')->store('public-notices', 'public');
        }

        // Publicar agora
        if (!isset($validated['published_at']) && $request->has('publish_now')) {
            $validated['published_at'] = now();
        }

        PublicNotice::create($validated);

        return redirect()
            ->route('admin.public-notices.index')
            ->with('success', 'Edital criado com sucesso!');
    }

    /**
     * Mostrar formulário de edição
     */
    public function edit(PublicNotice $publicNotice)
    {
        $types = PublicNotice::getTypes();
        $statuses = PublicNotice::getStatuses();
        return view('admin.public-notices.edit', compact('publicNotice', 'types', 'statuses'));
    }

    /**
     * Atualizar edital
     */
    public function update(Request $request, PublicNotice $publicNotice)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'summary' => 'required|string|max:1000',
            'content' => 'nullable|string',
            'institution' => 'required|string|max:255',
            'type' => 'required|in:pesquisa,extensao,bolsa,financiamento,outro',
            'status' => 'required|in:aberto,encerrado,em_analise,resultado',
            'opening_date' => 'nullable|date',
            'deadline' => 'nullable|date',
            'budget' => 'nullable|numeric|min:0',
            'external_link' => 'nullable|url|max:500',
            'file' => 'nullable|mimes:pdf|max:10240',
            'published_at' => 'nullable|date',
        ]);

        // Upload do novo arquivo
        if ($request->hasFile('file')) {
            if ($publicNotice->file) {
                Storage::disk('public')->delete($publicNotice->file);
            }
            $validated['file'] = $request->file('file')->store('public-notices', 'public');
        }

        // Publicar agora
        if (!isset($validated['published_at']) && $request->has('publish_now')) {
            $validated['published_at'] = now();
        }

        $publicNotice->update($validated);

        return redirect()
            ->route('admin.public-notices.index')
            ->with('success', 'Edital atualizado com sucesso!');
    }

    /**
     * Deletar edital
     */
    public function destroy(PublicNotice $publicNotice)
    {
        if ($publicNotice->file) {
            Storage::disk('public')->delete($publicNotice->file);
        }

        $publicNotice->delete();

        return redirect()
            ->route('admin.public-notices.index')
            ->with('success', 'Edital deletado com sucesso!');
    }

    /**
     * Publicar/despublicar edital
     */
    public function togglePublish(PublicNotice $publicNotice)
    {
        if ($publicNotice->published_at) {
            $publicNotice->update(['published_at' => null]);
            $message = 'Edital despublicado com sucesso!';
        } else {
            $publicNotice->update(['published_at' => now()]);
            $message = 'Edital publicado com sucesso!';
        }

        return redirect()
            ->route('admin.public-notices.index')
            ->with('success', $message);
    }
}

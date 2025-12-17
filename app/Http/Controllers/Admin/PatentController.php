<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Patent;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class PatentController extends Controller
{
    /**
     * Exibir lista de patentes no admin
     */
    public function index()
    {
        $patents = Patent::with('user')
            ->orderBy('created_at', 'desc')
            ->paginate(15);

        return view('admin.patents.index', compact('patents'));
    }

    /**
     * Mostrar formulário de criação
     */
    public function create()
    {
        $statuses = Patent::getStatuses();
        return view('admin.patents.create', compact('statuses'));
    }

    /**
     * Armazenar nova patente
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'patent_number' => 'nullable|string|max:100',
            'summary' => 'required|string|max:1000',
            'inventors' => 'required|string|max:500',
            'applicant' => 'nullable|string|max:255',
            'institution' => 'nullable|string|max:255',
            'filing_date' => 'nullable|date',
            'grant_date' => 'nullable|date',
            'status' => 'required|in:pendente,concedida,expirada,abandonada',
            'external_link' => 'nullable|url|max:500',
            'file' => 'nullable|mimes:pdf|max:10240',
            'published_at' => 'nullable|date',
        ]);

        $validated['user_id'] = Auth::id();

        // Upload do arquivo
        if ($request->hasFile('file')) {
            $validated['file'] = $request->file('file')->store('patents', 'public');
        }

        // Publicar agora
        if (!isset($validated['published_at']) && $request->has('publish_now')) {
            $validated['published_at'] = now();
        }

        Patent::create($validated);

        return redirect()
            ->route('admin.patents.index')
            ->with('success', 'Patente criada com sucesso!');
    }

    /**
     * Mostrar formulário de edição
     */
    public function edit(Patent $patent)
    {
        $statuses = Patent::getStatuses();
        return view('admin.patents.edit', compact('patent', 'statuses'));
    }

    /**
     * Atualizar patente
     */
    public function update(Request $request, Patent $patent)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'patent_number' => 'nullable|string|max:100',
            'summary' => 'required|string|max:1000',
            'inventors' => 'required|string|max:500',
            'applicant' => 'nullable|string|max:255',
            'institution' => 'nullable|string|max:255',
            'filing_date' => 'nullable|date',
            'grant_date' => 'nullable|date',
            'status' => 'required|in:pendente,concedida,expirada,abandonada',
            'external_link' => 'nullable|url|max:500',
            'file' => 'nullable|mimes:pdf|max:10240',
            'published_at' => 'nullable|date',
        ]);

        // Upload do novo arquivo
        if ($request->hasFile('file')) {
            if ($patent->file) {
                Storage::disk('public')->delete($patent->file);
            }
            $validated['file'] = $request->file('file')->store('patents', 'public');
        }

        // Publicar agora
        if (!isset($validated['published_at']) && $request->has('publish_now')) {
            $validated['published_at'] = now();
        }

        $patent->update($validated);

        return redirect()
            ->route('admin.patents.index')
            ->with('success', 'Patente atualizada com sucesso!');
    }

    /**
     * Deletar patente
     */
    public function destroy(Patent $patent)
    {
        if ($patent->file) {
            Storage::disk('public')->delete($patent->file);
        }

        $patent->delete();

        return redirect()
            ->route('admin.patents.index')
            ->with('success', 'Patente deletada com sucesso!');
    }

    /**
     * Publicar/despublicar patente
     */
    public function togglePublish(Patent $patent)
    {
        if ($patent->published_at) {
            $patent->update(['published_at' => null]);
            $message = 'Patente despublicada com sucesso!';
        } else {
            $patent->update(['published_at' => now()]);
            $message = 'Patente publicada com sucesso!';
        }

        return redirect()
            ->route('admin.patents.index')
            ->with('success', $message);
    }
}

<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Interview;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class InterviewController extends Controller
{
    /**
     * Exibir lista de entrevistas no admin
     */
    public function index()
    {
        $interviews = Interview::with('user')
            ->orderBy('created_at', 'desc')
            ->paginate(15);

        return view('admin.interviews.index', compact('interviews'));
    }

    /**
     * Mostrar formulário de criação
     */
    public function create()
    {
        return view('admin.interviews.create');
    }

    /**
     * Armazenar nova entrevista
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'summary' => 'required|string|max:1000',
            'content' => 'required|string',
            'interviewee_name' => 'required|string|max:255',
            'interviewee_role' => 'nullable|string|max:255',
            'video_url' => 'nullable|url|max:500',
            'image' => 'nullable|image|mimes:jpeg,jpg,png,webp|max:2048',
            'published_at' => 'nullable|date',
        ]);

        $validated['user_id'] = Auth::id();

        // Upload da imagem
        if ($request->hasFile('image')) {
            $validated['image'] = $request->file('image')->store('interviews', 'public');
        }

        // Se não tiver data de publicação definida, publicar agora
        if (!isset($validated['published_at']) && $request->has('publish_now')) {
            $validated['published_at'] = now();
        }

        $interview = Interview::create($validated);

        return redirect()
            ->route('admin.interviews.index')
            ->with('success', 'Entrevista criada com sucesso!');
    }

    /**
     * Mostrar formulário de edição
     */
    public function edit(Interview $interview)
    {
        return view('admin.interviews.edit', compact('interview'));
    }

    /**
     * Atualizar entrevista
     */
    public function update(Request $request, Interview $interview)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'summary' => 'required|string|max:1000',
            'content' => 'required|string',
            'interviewee_name' => 'required|string|max:255',
            'interviewee_role' => 'nullable|string|max:255',
            'video_url' => 'nullable|url|max:500',
            'image' => 'nullable|image|mimes:jpeg,jpg,png,webp|max:2048',
            'published_at' => 'nullable|date',
        ]);

        // Upload da nova imagem
        if ($request->hasFile('image')) {
            // Deletar imagem antiga
            if ($interview->image) {
                Storage::disk('public')->delete($interview->image);
            }
            $validated['image'] = $request->file('image')->store('interviews', 'public');
        }

        // Se marcou para publicar agora
        if (!isset($validated['published_at']) && $request->has('publish_now')) {
            $validated['published_at'] = now();
        }

        $interview->update($validated);

        return redirect()
            ->route('admin.interviews.index')
            ->with('success', 'Entrevista atualizada com sucesso!');
    }

    /**
     * Deletar entrevista
     */
    public function destroy(Interview $interview)
    {
        // Deletar imagem se existir
        if ($interview->image) {
            Storage::disk('public')->delete($interview->image);
        }

        $interview->delete();

        return redirect()
            ->route('admin.interviews.index')
            ->with('success', 'Entrevista deletada com sucesso!');
    }

    /**
     * Publicar/despublicar entrevista
     */
    public function togglePublish(Interview $interview)
    {
        if ($interview->published_at) {
            $interview->update(['published_at' => null]);
            $message = 'Entrevista despublicada com sucesso!';
        } else {
            $interview->update(['published_at' => now()]);
            $message = 'Entrevista publicada com sucesso!';
        }

        return redirect()
            ->route('admin.interviews.index')
            ->with('success', $message);
    }
}

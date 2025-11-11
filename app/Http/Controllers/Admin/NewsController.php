<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\News;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class NewsController extends Controller
{
    /**
     * Exibir lista de notícias no admin
     */
    public function index()
    {
        $news = News::with('user')
            ->orderBy('created_at', 'desc')
            ->paginate(15);

        return view('admin.news.index', compact('news'));
    }

    /**
     * Mostrar formulário de criação
     */
    public function create()
    {
        return view('admin.news.create');
    }

    /**
     * Armazenar nova notícia
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'summary' => 'required|string|max:500',
            'content' => 'required|string',
            'source' => 'nullable|string|max:255',
            'image' => 'nullable|image|mimes:jpeg,jpg,png,webp|max:2048',
            'published_at' => 'nullable|date',
        ]);

        $validated['user_id'] = Auth::id();

        // Upload da imagem
        if ($request->hasFile('image')) {
            $validated['image'] = $request->file('image')->store('news', 'public');
        }

        // Se não tiver data de publicação definida, publicar agora
        if (!isset($validated['published_at']) && $request->has('publish_now')) {
            $validated['published_at'] = now();
        }

        $news = News::create($validated);

        return redirect()
            ->route('admin.news.index')
            ->with('success', 'Notícia criada com sucesso!');
    }

    /**
     * Mostrar formulário de edição
     */
    public function edit(News $news)
    {
        return view('admin.news.edit', compact('news'));
    }

    /**
     * Atualizar notícia
     */
    public function update(Request $request, News $news)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'summary' => 'required|string|max:500',
            'content' => 'required|string',
            'source' => 'nullable|string|max:255',
            'image' => 'nullable|image|mimes:jpeg,jpg,png,webp|max:2048',
            'published_at' => 'nullable|date',
        ]);

        // Upload da nova imagem
        if ($request->hasFile('image')) {
            // Deletar imagem antiga
            if ($news->image) {
                Storage::disk('public')->delete($news->image);
            }
            $validated['image'] = $request->file('image')->store('news', 'public');
        }

        // Se marcou para publicar agora
        if (!isset($validated['published_at']) && $request->has('publish_now')) {
            $validated['published_at'] = now();
        }

        $news->update($validated);

        return redirect()
            ->route('admin.news.index')
            ->with('success', 'Notícia atualizada com sucesso!');
    }

    /**
     * Deletar notícia
     */
    public function destroy(News $news)
    {
        // Deletar imagem se existir
        if ($news->image) {
            Storage::disk('public')->delete($news->image);
        }

        $news->delete();

        return redirect()
            ->route('admin.news.index')
            ->with('success', 'Notícia deletada com sucesso!');
    }

    /**
     * Publicar/despublicar notícia
     */
    public function togglePublish(News $news)
    {
        if ($news->published_at) {
            $news->update(['published_at' => null]);
            $message = 'Notícia despublicada com sucesso!';
        } else {
            $news->update(['published_at' => now()]);
            $message = 'Notícia publicada com sucesso!';
        }

        return redirect()
            ->route('admin.news.index')
            ->with('success', $message);
    }
}

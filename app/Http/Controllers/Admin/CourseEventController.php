<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\CourseEvent;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class CourseEventController extends Controller
{
    /**
     * Exibir lista de cursos e eventos no admin
     */
    public function index()
    {
        $items = CourseEvent::with('user')
            ->orderBy('created_at', 'desc')
            ->paginate(15);

        return view('admin.courses-events.index', compact('items'));
    }

    /**
     * Mostrar formulário de criação
     */
    public function create()
    {
        return view('admin.courses-events.create');
    }

    /**
     * Armazenar novo curso/evento
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'summary' => 'required|string|max:500',
            'content' => 'nullable|string',
            'type' => 'required|in:curso,evento',
            'location' => 'nullable|string|max:255',
            'event_date' => 'nullable|date',
            'event_end_date' => 'nullable|date|after_or_equal:event_date',
            'event_time' => 'nullable|date_format:H:i',
            'registration_link' => 'nullable|url|max:500',
            'image' => 'nullable|image|mimes:jpeg,jpg,png,webp|max:2048',
            'published_at' => 'nullable|date',
        ]);

        $validated['user_id'] = Auth::id();

        // Upload da imagem
        if ($request->hasFile('image')) {
            $validated['image'] = $request->file('image')->store('courses-events', 'public');
        }

        // Se não tiver data de publicação definida, publicar agora
        if (!isset($validated['published_at']) && $request->has('publish_now')) {
            $validated['published_at'] = now();
        }

        $item = CourseEvent::create($validated);

        return redirect()
            ->route('admin.courses-events.index')
            ->with('success', 'Curso/Evento criado com sucesso!');
    }

    /**
     * Mostrar formulário de edição
     */
    public function edit(CourseEvent $courses_event)
    {
        return view('admin.courses-events.edit', ['item' => $courses_event]);
    }

    /**
     * Atualizar curso/evento
     */
    public function update(Request $request, CourseEvent $courses_event)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'summary' => 'required|string|max:500',
            'content' => 'nullable|string',
            'type' => 'required|in:curso,evento',
            'location' => 'nullable|string|max:255',
            'event_date' => 'nullable|date',
            'event_end_date' => 'nullable|date|after_or_equal:event_date',
            'event_time' => 'nullable|date_format:H:i',
            'registration_link' => 'nullable|url|max:500',
            'image' => 'nullable|image|mimes:jpeg,jpg,png,webp|max:2048',
            'published_at' => 'nullable|date',
        ]);

        // Upload da nova imagem
        if ($request->hasFile('image')) {
            // Deletar imagem antiga
            if ($courses_event->image) {
                Storage::disk('public')->delete($courses_event->image);
            }
            $validated['image'] = $request->file('image')->store('courses-events', 'public');
        }

        // Se marcou para publicar agora
        if (!isset($validated['published_at']) && $request->has('publish_now')) {
            $validated['published_at'] = now();
        }

        $courses_event->update($validated);

        return redirect()
            ->route('admin.courses-events.index')
            ->with('success', 'Curso/Evento atualizado com sucesso!');
    }

    /**
     * Deletar curso/evento
     */
    public function destroy(CourseEvent $courses_event)
    {
        // Deletar imagem se existir
        if ($courses_event->image) {
            Storage::disk('public')->delete($courses_event->image);
        }

        $courses_event->delete();

        return redirect()
            ->route('admin.courses-events.index')
            ->with('success', 'Curso/Evento deletado com sucesso!');
    }

    /**
     * Publicar/despublicar curso/evento
     */
    public function togglePublish(CourseEvent $courses_event)
    {
        if ($courses_event->published_at) {
            $courses_event->update(['published_at' => null]);
            $message = 'Curso/Evento despublicado com sucesso!';
        } else {
            $courses_event->update(['published_at' => now()]);
            $message = 'Curso/Evento publicado com sucesso!';
        }

        return redirect()
            ->route('admin.courses-events.index')
            ->with('success', $message);
    }
}

@extends('layouts.admin')

@section('page-title', 'Editar Curso/Evento')

@section('content')
<div class="max-w-4xl">
    <div class="bg-white rounded-lg shadow">
        <div class="p-4 sm:p-6 border-b border-gray-200 bg-gradient-to-r from-primary/5 to-secondary/5">
            <h3 class="text-lg font-semibold text-gray-900">Editar Curso/Evento</h3>
            <p class="text-sm text-gray-600 mt-1">Atualize as informações do curso ou evento</p>
        </div>

        <form action="{{ route('admin.courses-events.update', $item) }}" method="POST" enctype="multipart/form-data" class="p-4 sm:p-6 space-y-6">
            @csrf
            @method('PUT')

            <!-- Tipo -->
            <div>
                <label for="type" class="block text-sm font-medium text-gray-700 mb-2">
                    Tipo <span class="text-red-500">*</span>
                </label>
                <select 
                    name="type" 
                    id="type" 
                    class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary focus:border-transparent @error('type') border-red-500 @enderror"
                    required
                >
                    <option value="evento" {{ old('type', $item->type) == 'evento' ? 'selected' : '' }}>Evento</option>
                    <option value="curso" {{ old('type', $item->type) == 'curso' ? 'selected' : '' }}>Curso</option>
                </select>
                @error('type')
                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>

            <!-- Título -->
            <div>
                <label for="title" class="block text-sm font-medium text-gray-700 mb-2">
                    Título <span class="text-red-500">*</span>
                </label>
                <input 
                    type="text" 
                    name="title" 
                    id="title" 
                    value="{{ old('title', $item->title) }}"
                    class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary focus:border-transparent @error('title') border-red-500 @enderror"
                    required
                >
                @error('title')
                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>

            <!-- Resumo -->
            <div>
                <label for="summary" class="block text-sm font-medium text-gray-700 mb-2">
                    Resumo <span class="text-red-500">*</span>
                </label>
                <textarea 
                    name="summary" 
                    id="summary" 
                    rows="3"
                    class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary focus:border-transparent @error('summary') border-red-500 @enderror"
                    required
                >{{ old('summary', $item->summary) }}</textarea>
                <p class="mt-1 text-sm text-gray-500">Breve descrição (máximo 500 caracteres)</p>
                @error('summary')
                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>

            <!-- Datas e Hora do Evento -->
            <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                <div>
                    <label for="event_date" class="block text-sm font-medium text-gray-700 mb-2">
                        Data Inicial do Evento
                    </label>
                    <input 
                        type="date" 
                        name="event_date" 
                        id="event_date" 
                        value="{{ old('event_date', $item->event_date ? $item->event_date->format('Y-m-d') : '') }}"
                        class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary focus:border-transparent @error('event_date') border-red-500 @enderror"
                    >
                    @error('event_date')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label for="event_end_date" class="block text-sm font-medium text-gray-700 mb-2">
                        Data Final do Evento
                    </label>
                    <input 
                        type="date" 
                        name="event_end_date" 
                        id="event_end_date" 
                        value="{{ old('event_end_date', $item->event_end_date ? $item->event_end_date->format('Y-m-d') : '') }}"
                        class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary focus:border-transparent @error('event_end_date') border-red-500 @enderror"
                    >
                    @error('event_end_date')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label for="event_time" class="block text-sm font-medium text-gray-700 mb-2">
                        Horário
                    </label>
                    <input 
                        type="time" 
                        name="event_time" 
                        id="event_time" 
                        value="{{ old('event_time', $item->event_time ? \Carbon\Carbon::parse($item->event_time)->format('H:i') : '') }}"
                        class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary focus:border-transparent @error('event_time') border-red-500 @enderror"
                    >
                    @error('event_time')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>
            </div>

            <!-- Local -->
            <div>
                <label for="location" class="block text-sm font-medium text-gray-700 mb-2">
                    Local
                </label>
                <input 
                    type="text" 
                    name="location" 
                    id="location" 
                    value="{{ old('location', $item->location) }}"
                    class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary focus:border-transparent @error('location') border-red-500 @enderror"
                    placeholder="Ex: Auditório da UESC, Online, etc."
                >
                @error('location')
                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>

            <!-- Link do Evento -->
            <div>
                <label for="registration_link" class="block text-sm font-medium text-gray-700 mb-2">
                    Link do Evento
                </label>
                <input 
                    type="url" 
                    name="registration_link" 
                    id="registration_link" 
                    value="{{ old('registration_link', $item->registration_link) }}"
                    class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary focus:border-transparent @error('registration_link') border-red-500 @enderror"
                    placeholder="https://..."
                >
                @error('registration_link')
                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>

            <!-- Imagem Principal -->
            <div>
                <label for="image" class="block text-sm font-medium text-gray-700 mb-2">
                    Imagem Principal
                </label>
                
                @if($item->image)
                    <div class="mb-4">
                        <p class="text-sm text-gray-600 mb-2">Imagem atual:</p>
                        <img src="{{ $item->getImageUrl() }}" alt="{{ $item->title }}" class="max-w-md rounded-lg shadow">
                    </div>
                @endif
                
                <input 
                    type="file" 
                    name="image" 
                    id="image" 
                    accept="image/*"
                    class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary focus:border-transparent @error('image') border-red-500 @enderror"
                    onchange="previewImage(this)"
                >
                <p class="mt-1 text-sm text-gray-500">Formatos aceitos: JPG, PNG, WEBP (máximo 2MB)</p>
                @error('image')
                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                @enderror
                
                <div id="imagePreview" class="mt-4 hidden">
                    <p class="text-sm text-gray-600 mb-2">Nova imagem:</p>
                    <img src="" alt="Preview" class="max-w-md rounded-lg shadow">
                </div>
            </div>


            <!-- Data de Publicação -->
            <div>
                <label for="published_at" class="block text-sm font-medium text-gray-700 mb-2">
                    Data de Publicação
                </label>
                <input 
                    type="datetime-local" 
                    name="published_at" 
                    id="published_at" 
                    value="{{ old('published_at', $item->published_at ? $item->published_at->format('Y-m-d\TH:i') : '') }}"
                    class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary focus:border-transparent @error('published_at') border-red-500 @enderror"
                >
                <p class="mt-1 text-sm text-gray-500">Deixe em branco para salvar como rascunho</p>
                @error('published_at')
                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>

            <!-- Ações -->
            <div class="flex flex-col sm:flex-row gap-3 pt-6 border-t border-gray-200">
                <button 
                    type="submit" 
                    name="publish_now"
                    value="1"
                    class="inline-flex items-center justify-center gap-2 bg-primary text-white px-6 py-3 rounded-lg font-semibold hover:bg-opacity-90 transition-all shadow-sm hover:shadow-md"
                >
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                    </svg>
                    {{ $item->isPublished() ? 'Atualizar' : 'Publicar Agora' }}
                </button>
                
                <button 
                    type="submit"
                    class="inline-flex items-center justify-center gap-2 bg-gray-600 text-white px-6 py-3 rounded-lg font-semibold hover:bg-gray-700 transition-all"
                >
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7H5a2 2 0 00-2 2v9a2 2 0 002 2h14a2 2 0 002-2V9a2 2 0 00-2-2h-3m-1 4l-3 3m0 0l-3-3m3 3V4"></path>
                    </svg>
                    Salvar
                </button>
                
                <a href="{{ route('admin.courses-events.index') }}" class="inline-flex items-center justify-center gap-2 bg-gray-200 text-gray-700 px-6 py-3 rounded-lg font-semibold hover:bg-gray-300 transition-all">
                    Cancelar
                </a>
            </div>
        </form>
    </div>
</div>

<script>
function previewImage(input) {
    const preview = document.getElementById('imagePreview');
    const img = preview.querySelector('img');
    
    if (input.files && input.files[0]) {
        const reader = new FileReader();
        
        reader.onload = function(e) {
            img.src = e.target.result;
            preview.classList.remove('hidden');
        };
        
        reader.readAsDataURL(input.files[0]);
    }
}
</script>
@endsection

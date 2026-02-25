@extends('layouts.admin')

@section('page-title', 'Nova Notícia')

@section('content')
<div class="max-w-4xl">
    <div class="bg-white rounded-lg shadow">
        <div class="p-4 sm:p-6 border-b border-gray-200 bg-gradient-to-r from-primary/5 to-secondary/5">
            <h3 class="text-lg font-semibold text-gray-900">Criar Nova Notícia</h3>
            <p class="text-sm text-gray-600 mt-1">Preencha os campos abaixo para publicar uma nova notícia</p>
        </div>

        <form action="{{ route('admin.news.store') }}" method="POST" enctype="multipart/form-data" class="p-4 sm:p-6 space-y-6">
            @csrf

            <!-- Título -->
            <div>
                <label for="title" class="block text-sm font-medium text-gray-700 mb-2">
                    Título <span class="text-red-500">*</span>
                </label>
                <input 
                    type="text" 
                    name="title" 
                    id="title" 
                    value="{{ old('title') }}"
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
                >{{ old('summary') }}</textarea>
                <p class="mt-1 text-sm text-gray-500">Breve descrição da notícia (máximo 500 caracteres)</p>
                @error('summary')
                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>

            <!-- Imagem Principal -->
            <div>
                <label for="image" class="block text-sm font-medium text-gray-700 mb-2">
                    Imagem Principal
                </label>
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
                
                <!-- Preview da imagem -->
                <div id="imagePreview" class="mt-4 hidden">
                    <img src="" alt="Preview" class="max-w-md rounded-lg shadow">
                </div>
            </div>

            <!-- Fonte -->
            <div>
                <label for="source" class="block text-sm font-medium text-gray-700 mb-2">
                    Fonte
                </label>
                <input 
                    type="text" 
                    name="source" 
                    id="source" 
                    value="{{ old('source') }}"
                    class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary focus:border-transparent @error('source') border-red-500 @enderror"
                    placeholder="Ex: CEPLAC, UESC, etc."
                >
                @error('source')
                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>

            <!-- Link da Fonte -->
            <div>
                <label for="source_url" class="block text-sm font-medium text-gray-700 mb-2">
                    Link da fonte
                </label>
                <input 
                    type="url" 
                    name="source_url" 
                    id="source_url" 
                    value="{{ old('source_url') }}"
                    class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary focus:border-transparent @error('source_url') border-red-500 @enderror"
                    placeholder="https://exemplo.com/noticia-original"
                >
                <p class="mt-1 text-sm text-gray-500">URL da matéria original (opcional)</p>
                @error('source_url')
                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>

            <!-- Conteúdo -->
            <div>
                <label for="content" class="block text-sm font-medium text-gray-700 mb-2">
                    Conteúdo <span class="text-red-500">*</span>
                </label>
                <textarea 
                    name="content" 
                    id="content" 
                    rows="15"
                    class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary focus:border-transparent @error('content') border-red-500 @enderror"
                    required
                >{{ old('content') }}</textarea>
                <p class="mt-1 text-sm text-gray-500">Conteúdo completo da notícia</p>
                @error('content')
                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                @enderror
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
                    value="{{ old('published_at') }}"
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
                    Publicar Agora
                </button>
                
                <button 
                    type="submit"
                    class="inline-flex items-center justify-center gap-2 bg-gray-600 text-white px-6 py-3 rounded-lg font-semibold hover:bg-gray-700 transition-all"
                >
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7H5a2 2 0 00-2 2v9a2 2 0 002 2h14a2 2 0 002-2V9a2 2 0 00-2-2h-3m-1 4l-3 3m0 0l-3-3m3 3V4"></path>
                    </svg>
                    Salvar como Rascunho
                </button>

                <a 
                    href="{{ route('admin.news.index') }}"
                    class="inline-flex items-center justify-center gap-2 bg-white text-gray-700 px-6 py-3 rounded-lg font-semibold border border-gray-300 hover:bg-gray-50 transition-all"
                >
                    Cancelar
                </a>
            </div>
        </form>
    </div>
</div>
@endsection

@push('scripts')
<script>
function previewImage(input) {
    const preview = document.getElementById('imagePreview');
    const previewImg = preview.querySelector('img');
    
    if (input.files && input.files[0]) {
        const reader = new FileReader();
        
        reader.onload = function(e) {
            previewImg.src = e.target.result;
            preview.classList.remove('hidden');
        };
        
        reader.readAsDataURL(input.files[0]);
    } else {
        preview.classList.add('hidden');
    }
}
</script>
@endpush

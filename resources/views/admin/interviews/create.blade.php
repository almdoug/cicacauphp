@extends('layouts.admin')

@section('page-title', 'Nova Entrevista')

@section('content')
<div class="max-w-4xl">
    <div class="bg-white rounded-lg shadow">
        <div class="p-4 sm:p-6 border-b border-gray-200 bg-gradient-to-r from-primary/5 to-secondary/5">
            <h3 class="text-lg font-semibold text-gray-900">Criar Nova Entrevista</h3>
            <p class="text-sm text-gray-600 mt-1">Preencha os campos abaixo para cadastrar uma nova entrevista</p>
        </div>

        <form action="{{ route('admin.interviews.store') }}" method="POST" enctype="multipart/form-data" class="p-4 sm:p-6 space-y-6">
            @csrf

            <!-- Título -->
            <div>
                <label for="title" class="block text-sm font-medium text-gray-700 mb-2">
                    Título da Entrevista <span class="text-red-500">*</span>
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

            <!-- Dados do Entrevistado -->
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                <div>
                    <label for="interviewee_name" class="block text-sm font-medium text-gray-700 mb-2">
                        Nome do Entrevistado <span class="text-red-500">*</span>
                    </label>
                    <input 
                        type="text" 
                        name="interviewee_name" 
                        id="interviewee_name" 
                        value="{{ old('interviewee_name') }}"
                        class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary focus:border-transparent @error('interviewee_name') border-red-500 @enderror"
                        required
                    >
                    @error('interviewee_name')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label for="interviewee_role" class="block text-sm font-medium text-gray-700 mb-2">
                        Cargo/Função
                    </label>
                    <input 
                        type="text" 
                        name="interviewee_role" 
                        id="interviewee_role" 
                        value="{{ old('interviewee_role') }}"
                        class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary focus:border-transparent @error('interviewee_role') border-red-500 @enderror"
                        placeholder="Ex: Pesquisador da CEPLAC"
                    >
                    @error('interviewee_role')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>
            </div>

            <!-- Resumo -->
            <div>
                <label for="summary" class="block text-sm font-medium text-gray-700 mb-2">
                    Minicurriculo <span class="text-red-500">*</span>
                </label>
                <textarea 
                    name="summary" 
                    id="summary" 
                    rows="3"
                    maxlength="1000"
                    class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary focus:border-transparent @error('summary') border-red-500 @enderror"
                    required
                    oninput="updateSummaryCounter(this)"
                >{{ old('summary') }}</textarea>
                <div class="mt-1 flex items-center justify-between">
                    <p class="text-sm text-gray-500">Minicurrículo do entrevistado (máximo 1000 caracteres)</p>
                    <p id="summary-counter" class="text-sm text-gray-500"><span id="summary-count">{{ strlen(old('summary', '')) }}</span>/1000</p>
                </div>
                @error('summary')
                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>

            <!-- URL do Vídeo -->
            <div>
                <label for="video_url" class="block text-sm font-medium text-gray-700 mb-2">
                    URL do Vídeo (YouTube)
                </label>
                <input 
                    type="url" 
                    name="video_url" 
                    id="video_url" 
                    value="{{ old('video_url') }}"
                    class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary focus:border-transparent @error('video_url') border-red-500 @enderror"
                    placeholder="https://www.youtube.com/watch?v=..."
                >
                <p class="mt-1 text-sm text-gray-500">Cole o link do YouTube se a entrevista tiver vídeo</p>
                @error('video_url')
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
                
                <div id="imagePreview" class="mt-4 hidden">
                    <img src="" alt="Preview" class="max-w-md rounded-lg shadow">
                </div>
            </div>

            <!-- Conteúdo -->
            <div>
                <label for="content" class="block text-sm font-medium text-gray-700 mb-2">
                    Conteúdo da Entrevista <span class="text-red-500">*</span>
                </label>
                <textarea 
                    name="content" 
                    id="content" 
                    rows="20"
                    class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary focus:border-transparent @error('content') border-red-500 @enderror"
                    required
                >{{ old('content') }}</textarea>
                <p class="mt-1 text-sm text-gray-500">Transcrição ou texto completo da entrevista. Você pode usar HTML para formatar.</p>
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
                
                <a href="{{ route('admin.interviews.index') }}" class="inline-flex items-center justify-center gap-2 bg-gray-200 text-gray-700 px-6 py-3 rounded-lg font-semibold hover:bg-gray-300 transition-all">
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

function updateSummaryCounter(textarea) {
    const count = textarea.value.length;
    const max = 1000;
    const countEl = document.getElementById('summary-count');
    const counterEl = document.getElementById('summary-counter');
    countEl.textContent = count;
    if (count >= max) {
        counterEl.classList.add('text-red-600');
        counterEl.classList.remove('text-gray-500');
    } else if (count >= max * 0.9) {
        counterEl.classList.add('text-yellow-600');
        counterEl.classList.remove('text-gray-500', 'text-red-600');
    } else {
        counterEl.classList.remove('text-red-600', 'text-yellow-600');
        counterEl.classList.add('text-gray-500');
    }
}

document.addEventListener('DOMContentLoaded', function () {
    const textarea = document.getElementById('summary');
    if (textarea) updateSummaryCounter(textarea);

    const form = textarea ? textarea.closest('form') : null;
    if (form) {
        form.addEventListener('submit', function (e) {
            if (textarea.value.length > 1000) {
                e.preventDefault();
                textarea.focus();
                alert('O campo Minicurrículo ultrapassou o limite de 1000 caracteres. Por favor, reduza o texto antes de salvar.');
            }
        });
    }
});
</script>
@endsection

@extends('layouts.admin')

@section('page-title', 'Editar Edital')

@section('content')
<div class="max-w-4xl">
    <div class="bg-white rounded-lg shadow">
        <div class="p-4 sm:p-6 border-b border-gray-200 bg-gradient-to-r from-primary/5 to-secondary/5">
            <h3 class="text-lg font-semibold text-gray-900">Editar Edital</h3>
            <p class="text-sm text-gray-600 mt-1">Atualize os dados do edital</p>
        </div>

        <form action="{{ route('admin.public-notices.update', $publicNotice) }}" method="POST" enctype="multipart/form-data" class="p-4 sm:p-6 space-y-6">
            @csrf
            @method('PUT')

            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <!-- Título -->
                <div class="md:col-span-2">
                    <label for="title" class="block text-sm font-medium text-gray-700 mb-2">
                        Título <span class="text-red-500">*</span>
                    </label>
                    <input 
                        type="text" 
                        name="title" 
                        id="title" 
                        value="{{ old('title', $publicNotice->title) }}"
                        class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary focus:border-transparent @error('title') border-red-500 @enderror"
                        required
                    >
                    @error('title')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Instituição -->
                <div>
                    <label for="institution" class="block text-sm font-medium text-gray-700 mb-2">
                        Instituição <span class="text-red-500">*</span>
                    </label>
                    <input 
                        type="text" 
                        name="institution" 
                        id="institution" 
                        value="{{ old('institution', $publicNotice->institution) }}"
                        class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary focus:border-transparent @error('institution') border-red-500 @enderror"
                        required
                    >
                    @error('institution')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

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
                        @foreach($types as $key => $label)
                            <option value="{{ $key }}" {{ old('type', $publicNotice->type) == $key ? 'selected' : '' }}>{{ $label }}</option>
                        @endforeach
                    </select>
                    @error('type')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Status -->
                <div>
                    <label for="status" class="block text-sm font-medium text-gray-700 mb-2">
                        Status <span class="text-red-500">*</span>
                    </label>
                    <select 
                        name="status" 
                        id="status" 
                        class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary focus:border-transparent @error('status') border-red-500 @enderror"
                        required
                    >
                        @foreach($statuses as $key => $label)
                            <option value="{{ $key }}" {{ old('status', $publicNotice->status) == $key ? 'selected' : '' }}>{{ $label }}</option>
                        @endforeach
                    </select>
                    @error('status')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Valor -->
                <div>
                    <label for="budget" class="block text-sm font-medium text-gray-700 mb-2">
                        Valor Total (R$)
                    </label>
                    <input 
                        type="number" 
                        name="budget" 
                        id="budget" 
                        value="{{ old('budget', $publicNotice->budget) }}"
                        step="0.01"
                        min="0"
                        class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary focus:border-transparent @error('budget') border-red-500 @enderror"
                    >
                    @error('budget')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Data de Abertura -->
                <div>
                    <label for="opening_date" class="block text-sm font-medium text-gray-700 mb-2">
                        Data de Abertura
                    </label>
                    <input 
                        type="date" 
                        name="opening_date" 
                        id="opening_date" 
                        value="{{ old('opening_date', $publicNotice->opening_date?->format('Y-m-d')) }}"
                        class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary focus:border-transparent @error('opening_date') border-red-500 @enderror"
                    >
                    @error('opening_date')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Prazo -->
                <div>
                    <label for="deadline" class="block text-sm font-medium text-gray-700 mb-2">
                        Prazo para Inscrição
                    </label>
                    <input 
                        type="date" 
                        name="deadline" 
                        id="deadline" 
                        value="{{ old('deadline', $publicNotice->deadline?->format('Y-m-d')) }}"
                        class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary focus:border-transparent @error('deadline') border-red-500 @enderror"
                    >
                    @error('deadline')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>
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
                >{{ old('summary', $publicNotice->summary) }}</textarea>
                @error('summary')
                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>

            <!-- Conteúdo Detalhado -->
            <div>
                <label for="content" class="block text-sm font-medium text-gray-700 mb-2">
                    Detalhes do Edital
                </label>
                <textarea 
                    name="content" 
                    id="content" 
                    rows="8"
                    class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary focus:border-transparent @error('content') border-red-500 @enderror"
                >{{ old('content', $publicNotice->content) }}</textarea>
                @error('content')
                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <!-- Arquivo PDF -->
                <div>
                    <label for="file" class="block text-sm font-medium text-gray-700 mb-2">
                        Arquivo do Edital (PDF)
                    </label>
                    @if($publicNotice->file)
                        <div class="mb-2 p-3 bg-gray-50 rounded-lg flex items-center justify-between">
                            <span class="text-sm text-gray-600">Arquivo atual: {{ basename($publicNotice->file) }}</span>
                            <a href="{{ $publicNotice->getFileUrl() }}" target="_blank" class="text-primary hover:underline text-sm">Ver</a>
                        </div>
                    @endif
                    <input 
                        type="file" 
                        name="file" 
                        id="file" 
                        accept=".pdf"
                        class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary focus:border-transparent @error('file') border-red-500 @enderror"
                    >
                    <p class="mt-1 text-sm text-gray-500">Deixe em branco para manter o arquivo atual</p>
                    @error('file')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Link Externo -->
                <div>
                    <label for="external_link" class="block text-sm font-medium text-gray-700 mb-2">
                        Link para Inscrição
                    </label>
                    <input 
                        type="url" 
                        name="external_link" 
                        id="external_link" 
                        value="{{ old('external_link', $publicNotice->external_link) }}"
                        class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary focus:border-transparent @error('external_link') border-red-500 @enderror"
                        placeholder="https://..."
                    >
                    @error('external_link')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>
            </div>

            <!-- Data de Publicação no Site -->
            <div>
                <label for="published_at" class="block text-sm font-medium text-gray-700 mb-2">
                    Data de Publicação no Site
                </label>
                <input 
                    type="datetime-local" 
                    name="published_at" 
                    id="published_at" 
                    value="{{ old('published_at', $publicNotice->published_at ? $publicNotice->published_at->format('Y-m-d\TH:i') : '') }}"
                    class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary focus:border-transparent @error('published_at') border-red-500 @enderror"
                >
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
                    Salvar e Publicar
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

                <a 
                    href="{{ route('admin.public-notices.index') }}"
                    class="inline-flex items-center justify-center gap-2 bg-white text-gray-700 px-6 py-3 rounded-lg font-semibold border border-gray-300 hover:bg-gray-50 transition-all"
                >
                    Cancelar
                </a>
            </div>
        </form>
    </div>
</div>
@endsection

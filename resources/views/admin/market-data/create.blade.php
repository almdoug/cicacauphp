@extends('layouts.admin')

@section('page-title', 'Novo Dado de Mercado')

@section('content')
<div class="max-w-4xl">
    <div class="bg-white rounded-lg shadow">
        <div class="p-4 sm:p-6 border-b border-gray-200 bg-gradient-to-r from-primary/5 to-secondary/5">
            <h3 class="text-lg font-semibold text-gray-900">Cadastrar Novo Dado de Mercado</h3>
            <p class="text-sm text-gray-600 mt-1">Preencha os campos abaixo para cadastrar um novo dado de mercado</p>
        </div>

        <form action="{{ route('admin.market-data.store') }}" method="POST" enctype="multipart/form-data" class="p-4 sm:p-6 space-y-6">
            @csrf

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
                        value="{{ old('title') }}"
                        class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary focus:border-transparent @error('title') border-red-500 @enderror"
                        required
                    >
                    @error('title')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Categoria -->
                <div>
                    <label for="category" class="block text-sm font-medium text-gray-700 mb-2">
                        Categoria <span class="text-red-500">*</span>
                    </label>
                    <select 
                        name="category" 
                        id="category" 
                        class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary focus:border-transparent @error('category') border-red-500 @enderror"
                        required
                    >
                        @foreach($categories as $key => $label)
                            <option value="{{ $key }}" {{ old('category') == $key ? 'selected' : '' }}>{{ $label }}</option>
                        @endforeach
                    </select>
                    @error('category')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Escopo -->
                <div>
                    <label for="scope" class="block text-sm font-medium text-gray-700 mb-2">
                        Escopo <span class="text-red-500">*</span>
                    </label>
                    <select 
                        name="scope" 
                        id="scope" 
                        class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary focus:border-transparent @error('scope') border-red-500 @enderror"
                        required
                    >
                        @foreach($scopes as $key => $label)
                            <option value="{{ $key }}" {{ old('scope', 'nacional') == $key ? 'selected' : '' }}>{{ $label }}</option>
                        @endforeach
                    </select>
                    @error('scope')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Região/País -->
                <div>
                    <label for="region" class="block text-sm font-medium text-gray-700 mb-2">
                        Região/País
                    </label>
                    <input 
                        type="text" 
                        name="region" 
                        id="region" 
                        value="{{ old('region') }}"
                        class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary focus:border-transparent @error('region') border-red-500 @enderror"
                        placeholder="Ex: Brasil, Bahia, Costa do Marfim"
                    >
                    @error('region')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Período -->
                <div>
                    <label for="period" class="block text-sm font-medium text-gray-700 mb-2">
                        Período
                    </label>
                    <input 
                        type="text" 
                        name="period" 
                        id="period" 
                        value="{{ old('period') }}"
                        class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary focus:border-transparent @error('period') border-red-500 @enderror"
                        placeholder="Ex: 2024, Q1 2024, Jan-Mar 2024"
                    >
                    @error('period')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Valor -->
                <div>
                    <label for="value" class="block text-sm font-medium text-gray-700 mb-2">
                        Valor
                    </label>
                    <input 
                        type="number" 
                        name="value" 
                        id="value" 
                        value="{{ old('value') }}"
                        step="0.01"
                        class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary focus:border-transparent @error('value') border-red-500 @enderror"
                        placeholder="0.00"
                    >
                    @error('value')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Unidade -->
                <div>
                    <label for="unit" class="block text-sm font-medium text-gray-700 mb-2">
                        Unidade
                    </label>
                    <input 
                        type="text" 
                        name="unit" 
                        id="unit" 
                        value="{{ old('unit') }}"
                        class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary focus:border-transparent @error('unit') border-red-500 @enderror"
                        placeholder="Ex: toneladas, US$/ton, R$/kg"
                    >
                    @error('unit')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Variação -->
                <div>
                    <label for="variation" class="block text-sm font-medium text-gray-700 mb-2">
                        Variação (%)
                    </label>
                    <input 
                        type="number" 
                        name="variation" 
                        id="variation" 
                        value="{{ old('variation') }}"
                        step="0.01"
                        class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary focus:border-transparent @error('variation') border-red-500 @enderror"
                        placeholder="Ex: 5.50 ou -3.25"
                    >
                    <p class="mt-1 text-sm text-gray-500">Use valores negativos para queda</p>
                    @error('variation')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Fonte -->
                <div>
                    <label for="source" class="block text-sm font-medium text-gray-700 mb-2">
                        Fonte dos Dados
                    </label>
                    <input 
                        type="text" 
                        name="source" 
                        id="source" 
                        value="{{ old('source') }}"
                        class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary focus:border-transparent @error('source') border-red-500 @enderror"
                        placeholder="Ex: IBGE, CEPLAC, ICCO, CONAB"
                    >
                    @error('source')
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
                >{{ old('summary') }}</textarea>
                <p class="mt-1 text-sm text-gray-500">Breve descrição (máximo 1000 caracteres)</p>
                @error('summary')
                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>

            <!-- Conteúdo Detalhado -->
            <div>
                <label for="content" class="block text-sm font-medium text-gray-700 mb-2">
                    Análise/Detalhes
                </label>
                <textarea 
                    name="content" 
                    id="content" 
                    rows="8"
                    class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary focus:border-transparent @error('content') border-red-500 @enderror"
                >{{ old('content') }}</textarea>
                @error('content')
                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <!-- Arquivo -->
                <div>
                    <label for="file" class="block text-sm font-medium text-gray-700 mb-2">
                        Arquivo (PDF, Excel, Imagem)
                    </label>
                    <input 
                        type="file" 
                        name="file" 
                        id="file" 
                        accept=".pdf,.xlsx,.xls,.csv,.png,.jpg,.jpeg"
                        class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary focus:border-transparent @error('file') border-red-500 @enderror"
                    >
                    <p class="mt-1 text-sm text-gray-500">Formatos: PDF, Excel, CSV, PNG, JPG (máximo 10MB)</p>
                    @error('file')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Link Externo -->
                <div>
                    <label for="external_link" class="block text-sm font-medium text-gray-700 mb-2">
                        Link Externo
                    </label>
                    <input 
                        type="url" 
                        name="external_link" 
                        id="external_link" 
                        value="{{ old('external_link') }}"
                        class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary focus:border-transparent @error('external_link') border-red-500 @enderror"
                        placeholder="https://..."
                    >
                    @error('external_link')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
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
                    href="{{ route('admin.market-data.index') }}"
                    class="inline-flex items-center justify-center gap-2 bg-white text-gray-700 px-6 py-3 rounded-lg font-semibold border border-gray-300 hover:bg-gray-50 transition-all"
                >
                    Cancelar
                </a>
            </div>
        </form>
    </div>
</div>
@endsection

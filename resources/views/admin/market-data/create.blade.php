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

                <!-- Frequência -->
                <div>
                    <label for="frequency" class="block text-sm font-medium text-gray-700 mb-2">
                        Frequência
                    </label>
                    <input 
                        type="text" 
                        name="frequency" 
                        id="frequency" 
                        value="{{ old('frequency') }}"
                        class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary focus:border-transparent @error('frequency') border-red-500 @enderror"
                        placeholder="Ex: Mensal, Trimestral, Anual"
                    >
                    @error('frequency')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
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
                        value="{{ old('location', 'Brasil') }}"
                        class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary focus:border-transparent @error('location') border-red-500 @enderror"
                    >
                    @error('location')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
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
                        placeholder="Ex: ICCO, NASDAQ, SECEX"
                    >
                    @error('source')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Link da Fonte -->
                <div>
                    <label for="source_link" class="block text-sm font-medium text-gray-700 mb-2">
                        Link da Fonte (opcional)
                    </label>
                    <input 
                        type="url" 
                        name="source_link" 
                        id="source_link" 
                        value="{{ old('source_link') }}"
                        class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary focus:border-transparent @error('source_link') border-red-500 @enderror"
                        placeholder="https://exemplo.com"
                    >
                    @error('source_link')
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
                        placeholder="Ex: USD/ton, R$/kg, Toneladas"
                    >
                    @error('unit')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Atualizado em -->
                <div>
                    <label for="updated_at_data" class="block text-sm font-medium text-gray-700 mb-2">
                        Atualizado em
                    </label>
                    <input 
                        type="date" 
                        name="updated_at_data" 
                        id="updated_at_data" 
                        value="{{ old('updated_at_data') }}"
                        class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary focus:border-transparent @error('updated_at_data') border-red-500 @enderror"
                    >
                    @error('updated_at_data')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>
            </div>

            <!-- Comentário -->
            <div>
                <label for="comment" class="block text-sm font-medium text-gray-700 mb-2">
                    Comentário/Observações
                </label>
                <textarea 
                    name="comment" 
                    id="comment" 
                    rows="3"
                    class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary focus:border-transparent @error('comment') border-red-500 @enderror"
                >{{ old('comment') }}</textarea>
                @error('comment')
                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>

            <!-- Séries de Dados para Gráfico/Tabela -->
            @include('admin.partials.data-series-form', ['dataItems' => collect()])

            <!-- Ações -->
            <div class="flex flex-col sm:flex-row gap-3 pt-6 border-t border-gray-200">
                <button 
                    type="submit"
                    class="inline-flex items-center justify-center gap-2 bg-primary text-white px-6 py-3 rounded-lg font-semibold hover:bg-opacity-90 transition-all shadow-sm hover:shadow-md"
                >
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                    </svg>
                    Salvar Dado
                </button>

                <a 
                    href="{{ route('admin.market-data.index') }}" 
                    class="inline-flex items-center justify-center gap-2 bg-gray-100 text-gray-700 px-6 py-3 rounded-lg font-semibold hover:bg-gray-200 transition-all"
                >
                    Cancelar
                </a>
            </div>
        </form>
    </div>
</div>
@endsection

@extends('layouts.admin')

@section('page-title', 'Editar Custo de Produção')

@section('content')
<div class="max-w-4xl">
    <div class="bg-white rounded-lg shadow">
        <div class="p-4 sm:p-6 border-b border-gray-200 bg-gradient-to-r from-primary/5 to-secondary/5">
            <h3 class="text-lg font-semibold text-gray-900">Editar Custo de Produção</h3>
            <p class="text-sm text-gray-600 mt-1">Atualize os dados do custo de produção</p>
        </div>

        <form action="{{ route('admin.production-costs.update', $productionCost) }}" method="POST" class="p-4 sm:p-6 space-y-6">
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
                        value="{{ old('title', $productionCost->title) }}"
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
                        value="{{ old('frequency', $productionCost->frequency) }}"
                        class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary focus:border-transparent @error('frequency') border-red-500 @enderror"
                        placeholder="Ex: Mensal, Trimestral, Anual"
                    >
                    @error('frequency')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <!-- País -->
                <div>
                    <label for="country" class="block text-sm font-medium text-gray-700 mb-2">
                        País
                    </label>
                    <input 
                        type="text" 
                        name="country" 
                        id="country" 
                        value="{{ old('country', $productionCost->country ?? 'Brasil') }}"
                        class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary focus:border-transparent @error('country') border-red-500 @enderror"
                    >
                    @error('country')
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
                        value="{{ old('source', $productionCost->source) }}"
                        class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary focus:border-transparent @error('source') border-red-500 @enderror"
                    >
                    @error('source')
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
                        value="{{ old('unit', $productionCost->unit) }}"
                        class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary focus:border-transparent @error('unit') border-red-500 @enderror"
                        placeholder="Ex: R$/ha, R$/kg, R$/arroba"
                    >
                    @error('unit')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Atualizado em (data) -->
                <div>
                    <label for="updated_at_data" class="block text-sm font-medium text-gray-700 mb-2">
                        Atualizado em
                    </label>
                    <input 
                        type="date" 
                        name="updated_at_data" 
                        id="updated_at_data" 
                        value="{{ old('updated_at_data', $productionCost->updated_at_data ? $productionCost->updated_at_data->format('Y-m-d') : '') }}"
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
                >{{ old('comment', $productionCost->comment) }}</textarea>
                <p class="mt-1 text-sm text-gray-500">Observações ou comentários sobre os dados</p>
                @error('comment')
                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>

            <!-- Séries de Dados para Gráfico/Tabela -->
            @include('admin.partials.data-series-form', ['dataItems' => $productionCost->dataSeries])

            <!-- Botão Exportar Excel -->
            @if($productionCost->dataSeries->count() > 0)
            <div class="bg-blue-50 border border-blue-200 rounded-lg p-4">
                <div class="flex items-center justify-between">
                    <div class="flex items-center gap-3">
                        <svg class="w-10 h-10 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                        </svg>
                        <div>
                            <h5 class="text-sm font-semibold text-gray-900">Exportar Dados</h5>
                            <p class="text-sm text-gray-600">{{ $productionCost->dataSeries->count() }} pontos de dados disponíveis</p>
                        </div>
                    </div>
                    <a 
                        href="{{ route('admin.production-costs.export', $productionCost) }}" 
                        class="inline-flex items-center gap-2 px-4 py-2 bg-green-600 text-white rounded-lg text-sm font-medium hover:bg-green-700 transition-colors"
                    >
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 10v6m0 0l-3-3m3 3l3-3m2 8H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                        </svg>
                        Planilha
                    </a>
                </div>
            </div>
            @endif

            <!-- Ações -->
            <div class="flex flex-col sm:flex-row gap-3 pt-6 border-t border-gray-200">
                <button 
                    type="submit"
                    class="inline-flex items-center justify-center gap-2 bg-primary text-white px-6 py-3 rounded-lg font-semibold hover:bg-opacity-90 transition-all shadow-sm hover:shadow-md"
                >
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7H5a2 2 0 00-2 2v9a2 2 0 002 2h14a2 2 0 002-2V9a2 2 0 00-2-2h-3m-1 4l-3 3m0 0l-3-3m3 3V4"></path>
                    </svg>
                    Salvar
                </button>

                <a 
                    href="{{ route('admin.production-costs.index') }}"
                    class="inline-flex items-center justify-center gap-2 bg-white text-gray-700 px-6 py-3 rounded-lg font-semibold border border-gray-300 hover:bg-gray-50 transition-all"
                >
                    Cancelar
                </a>
            </div>
        </form>
    </div>
</div>
@endsection

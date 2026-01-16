@extends('layouts.admin')

@section('page-title', 'Editar Custo de Produção')

@section('content')
<div class="max-w-4xl">
    <div class="bg-white rounded-lg shadow">
        <div class="p-4 sm:p-6 border-b border-gray-200 bg-gradient-to-r from-primary/5 to-secondary/5">
            <h3 class="text-lg font-semibold text-gray-900">Editar Custo de Produção</h3>
            <p class="text-sm text-gray-600 mt-1">Atualize os dados do custo de produção</p>
        </div>

        <form action="{{ route('admin.production-costs.update', $productionCost) }}" method="POST" enctype="multipart/form-data" class="p-4 sm:p-6 space-y-6">
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

            <!-- Arquivo Atual -->
            @if($productionCost->file_pdf_path || $productionCost->file_spreadsheet_path)
            <div class="space-y-4">
                @if($productionCost->file_pdf_path)
                <div class="bg-red-50 border border-red-200 rounded-lg p-4">
                    <div class="flex items-center justify-between">
                        <div class="flex items-center gap-3">
                            <svg class="w-10 h-10 text-red-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 21h10a2 2 0 002-2V9.414a1 1 0 00-.293-.707l-5.414-5.414A1 1 0 0012.586 3H7a2 2 0 00-2 2v14a2 2 0 002 2z"></path>
                            </svg>
                            <div>
                                <h5 class="text-sm font-semibold text-gray-900">PDF Anexado</h5>
                                <p class="text-sm text-gray-600">{{ $productionCost->file_pdf_name ?? 'arquivo.pdf' }}</p>
                            </div>
                        </div>
                        <div class="flex items-center gap-2">
                            <a 
                                href="{{ route('admin.production-costs.export', ['production_cost' => $productionCost, 'type' => 'pdf']) }}" 
                                class="inline-flex items-center gap-2 px-4 py-2 bg-red-600 text-white rounded-lg text-sm font-medium hover:bg-red-700 transition-colors"
                                target="_blank"
                            >
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 10v6m0 0l-3-3m3 3l3-3m2 8H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                                </svg>
                                Baixar
                            </a>
                            <label class="inline-flex items-center gap-2 px-4 py-2 bg-red-100 text-red-700 rounded-lg text-sm font-medium hover:bg-red-200 transition-colors cursor-pointer">
                                <input type="checkbox" name="remove_pdf" value="1" class="rounded">
                                Remover
                            </label>
                        </div>
                    </div>
                </div>
                @endif

                @if($productionCost->file_spreadsheet_path)
                <div class="bg-green-50 border border-green-200 rounded-lg p-4">
                    <div class="flex items-center justify-between">
                        <div class="flex items-center gap-3">
                            <svg class="w-10 h-10 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                            </svg>
                            <div>
                                <h5 class="text-sm font-semibold text-gray-900">Planilha Anexada</h5>
                                <p class="text-sm text-gray-600">{{ $productionCost->file_spreadsheet_name ?? 'planilha' }}</p>
                            </div>
                        </div>
                        <div class="flex items-center gap-2">
                            <a 
                                href="{{ route('admin.production-costs.export', ['production_cost' => $productionCost, 'type' => 'spreadsheet']) }}" 
                                class="inline-flex items-center gap-2 px-4 py-2 bg-green-600 text-white rounded-lg text-sm font-medium hover:bg-green-700 transition-colors"
                                target="_blank"
                            >
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 10v6m0 0l-3-3m3 3l3-3m2 8H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                                </svg>
                                Baixar
                            </a>
                            <label class="inline-flex items-center gap-2 px-4 py-2 bg-green-100 text-green-700 rounded-lg text-sm font-medium hover:bg-green-200 transition-colors cursor-pointer">
                                <input type="checkbox" name="remove_spreadsheet" value="1" class="rounded">
                                Remover
                            </label>
                        </div>
                    </div>
                </div>
                @endif
            </div>
            @endif

            <!-- Upload de Novo PDF -->
            <div>
                <label for="file_pdf" class="block text-sm font-medium text-gray-700 mb-2">
                    {{ $productionCost->file_pdf_path ? 'Substituir PDF' : 'Arquivo PDF' }}
                </label>
                <div class="flex items-center gap-4">
                    <input 
                        type="file" 
                        name="file_pdf" 
                        id="file_pdf" 
                        accept=".pdf"
                        class="block w-full text-sm text-gray-500
                            file:mr-4 file:py-2 file:px-4
                            file:rounded-lg file:border-0
                            file:text-sm file:font-semibold
                            file:bg-red-600 file:text-white
                            hover:file:bg-red-700
                            @error('file_pdf') border-red-500 @enderror"
                    >
                </div>
                <p class="mt-1 text-sm text-gray-500">Formato aceito: PDF (máximo 10MB)</p>
                @error('file_pdf')
                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>

            <!-- Upload de Nova Planilha -->
            <div>
                <label for="file_spreadsheet" class="block text-sm font-medium text-gray-700 mb-2">
                    {{ $productionCost->file_spreadsheet_path ? 'Substituir Planilha' : 'Planilha (Excel/CSV)' }}
                </label>
                <div class="flex items-center gap-4">
                    <input 
                        type="file" 
                        name="file_spreadsheet" 
                        id="file_spreadsheet" 
                        accept=".xlsx,.xls,.csv"
                        class="block w-full text-sm text-gray-500
                            file:mr-4 file:py-2 file:px-4
                            file:rounded-lg file:border-0
                            file:text-sm file:font-semibold
                            file:bg-green-600 file:text-white
                            hover:file:bg-green-700
                            @error('file_spreadsheet') border-red-500 @enderror"
                    >
                </div>
                <p class="mt-1 text-sm text-gray-500">Formatos aceitos: XLSX, XLS, CSV (máximo 10MB)</p>
                @error('file_spreadsheet')
                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>

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

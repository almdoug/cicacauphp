@extends('layouts.admin')

@section('page-title', 'Nova Patente')

@section('content')
<div class="max-w-4xl">
    <div class="bg-white rounded-lg shadow">
        <div class="p-4 sm:p-6 border-b border-gray-200 bg-gradient-to-r from-primary/5 to-secondary/5">
            <h3 class="text-lg font-semibold text-gray-900">Cadastrar Nova Patente</h3>
            <p class="text-sm text-gray-600 mt-1">Preencha os campos abaixo para cadastrar uma nova patente</p>
        </div>

        <form action="{{ route('admin.patents.store') }}" method="POST" enctype="multipart/form-data" class="p-4 sm:p-6 space-y-6">
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

                <!-- Número da Patente -->
                <div>
                    <label for="patent_number" class="block text-sm font-medium text-gray-700 mb-2">
                        Número da Patente
                    </label>
                    <input 
                        type="text" 
                        name="patent_number" 
                        id="patent_number" 
                        value="{{ old('patent_number') }}"
                        class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary focus:border-transparent @error('patent_number') border-red-500 @enderror"
                        placeholder="Ex: BR 10 2021 012345 6"
                    >
                    @error('patent_number')
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
                            <option value="{{ $key }}" {{ old('status') == $key ? 'selected' : '' }}>{{ $label }}</option>
                        @endforeach
                    </select>
                    @error('status')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Inventores -->
                <div class="md:col-span-2">
                    <label for="inventors" class="block text-sm font-medium text-gray-700 mb-2">
                        Inventores <span class="text-red-500">*</span>
                    </label>
                    <input 
                        type="text" 
                        name="inventors" 
                        id="inventors" 
                        value="{{ old('inventors') }}"
                        class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary focus:border-transparent @error('inventors') border-red-500 @enderror"
                        placeholder="Ex: Silva, J. A.; Santos, M. B."
                        required
                    >
                    @error('inventors')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Depositante -->
                <div>
                    <label for="applicant" class="block text-sm font-medium text-gray-700 mb-2">
                        Depositante/Titular
                    </label>
                    <input 
                        type="text" 
                        name="applicant" 
                        id="applicant" 
                        value="{{ old('applicant') }}"
                        class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary focus:border-transparent @error('applicant') border-red-500 @enderror"
                    >
                    @error('applicant')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Instituição -->
                <div>
                    <label for="institution" class="block text-sm font-medium text-gray-700 mb-2">
                        Instituição
                    </label>
                    <input 
                        type="text" 
                        name="institution" 
                        id="institution" 
                        value="{{ old('institution') }}"
                        class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary focus:border-transparent @error('institution') border-red-500 @enderror"
                        placeholder="Ex: UESC, CEPLAC, Embrapa"
                    >
                    @error('institution')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Data de Depósito -->
                <div>
                    <label for="filing_date" class="block text-sm font-medium text-gray-700 mb-2">
                        Data de Depósito
                    </label>
                    <input 
                        type="date" 
                        name="filing_date" 
                        id="filing_date" 
                        value="{{ old('filing_date') }}"
                        class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary focus:border-transparent @error('filing_date') border-red-500 @enderror"
                    >
                    @error('filing_date')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Data de Concessão -->
                <div>
                    <label for="grant_date" class="block text-sm font-medium text-gray-700 mb-2">
                        Data de Concessão
                    </label>
                    <input 
                        type="date" 
                        name="grant_date" 
                        id="grant_date" 
                        value="{{ old('grant_date') }}"
                        class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary focus:border-transparent @error('grant_date') border-red-500 @enderror"
                    >
                    @error('grant_date')
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
                    rows="4"
                    class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary focus:border-transparent @error('summary') border-red-500 @enderror"
                    required
                >{{ old('summary') }}</textarea>
                <p class="mt-1 text-sm text-gray-500">Resumo da patente (máximo 1000 caracteres)</p>
                @error('summary')
                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <!-- Arquivo PDF -->
                <div>
                    <label for="file" class="block text-sm font-medium text-gray-700 mb-2">
                        Documento PDF
                    </label>
                    <input 
                        type="file" 
                        name="file" 
                        id="file" 
                        accept=".pdf"
                        class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary focus:border-transparent @error('file') border-red-500 @enderror"
                    >
                    <p class="mt-1 text-sm text-gray-500">Formato PDF (máximo 10MB)</p>
                    @error('file')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Link Externo -->
                <div>
                    <label for="external_link" class="block text-sm font-medium text-gray-700 mb-2">
                        Link INPI/Externo
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

            <!-- Data de Publicação no Site -->
            <div>
                <label for="published_at" class="block text-sm font-medium text-gray-700 mb-2">
                    Data de Publicação no Site
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
                    href="{{ route('admin.patents.index') }}"
                    class="inline-flex items-center justify-center gap-2 bg-white text-gray-700 px-6 py-3 rounded-lg font-semibold border border-gray-300 hover:bg-gray-50 transition-all"
                >
                    Cancelar
                </a>
            </div>
        </form>
    </div>
</div>
@endsection

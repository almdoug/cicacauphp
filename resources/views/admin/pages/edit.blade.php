@extends('layouts.admin')

@section('page-title', 'Editar ' . ucfirst($page))

@section('content')
<div class="space-y-6">
    <!-- Header -->
    <div class="flex items-center justify-between">
        <div>
            <h3 class="text-2xl font-bold text-gray-900">Editar Conteúdo da Página</h3>
            <p class="text-gray-600 mt-1">{{ ucfirst($page) }}</p>
        </div>
        <a href="{{ route('admin.dashboard') }}" class="inline-flex items-center gap-2 text-gray-600 hover:text-gray-900 transition-colors">
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path>
            </svg>
            Voltar
        </a>
    </div>

    <!-- Form -->
    <form method="POST" action="{{ route('admin.pages.update', $page) }}" class="space-y-6">
        @csrf
        @method('PUT')

        @foreach($contents as $section => $items)
            <div class="bg-white rounded-lg shadow">
                <div class="p-6 border-b border-gray-200">
                    <h4 class="text-lg font-semibold text-gray-900 capitalize">{{ str_replace('_', ' ', $section) }}</h4>
                </div>
                <div class="p-6 space-y-4">
                    @foreach($items as $item)
                        <div>
                            <label for="{{ $section }}_{{ $item->key }}" class="block text-sm font-medium text-gray-700 mb-2 capitalize">
                                {{ str_replace('_', ' ', $item->key) }}
                            </label>
                            
                            @if($item->type === 'textarea')
                                <textarea 
                                    id="{{ $section }}_{{ $item->key }}"
                                    name="contents[{{ $section }}][{{ $item->key }}]"
                                    rows="4"
                                    class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary focus:border-transparent transition-all"
                                >{{ $item->value }}</textarea>
                            @else
                                <input 
                                    type="text" 
                                    id="{{ $section }}_{{ $item->key }}"
                                    name="contents[{{ $section }}][{{ $item->key }}]"
                                    value="{{ $item->value }}"
                                    class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary focus:border-transparent transition-all"
                                >
                            @endif
                            
                            @if($item->key === 'button_link')
                                <p class="mt-1 text-sm text-gray-500">URL do link (ex: /mercado, https://exemplo.com)</p>
                            @endif
                        </div>
                    @endforeach
                </div>
            </div>
        @endforeach

        <!-- Actions -->
        <div class="flex items-center justify-end gap-4 bg-white rounded-lg shadow p-6">
            <a href="{{ route('admin.dashboard') }}" class="px-6 py-3 border border-gray-300 text-gray-700 rounded-lg font-medium hover:bg-gray-50 transition-colors">
                Cancelar
            </a>
            <button 
                type="submit" 
                class="px-6 py-3 bg-primary text-white rounded-lg font-semibold hover:bg-opacity-90 transition-all shadow-lg hover:shadow-xl"
            >
                Salvar Alterações
            </button>
        </div>
    </form>

    <!-- Preview Link -->
    <div class="bg-blue-50 border border-blue-200 rounded-lg p-4 flex items-center justify-between">
        <div class="flex items-center gap-3">
            <svg class="w-5 h-5 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
            </svg>
            <span class="text-sm text-blue-800">Após salvar, visualize as alterações no site público</span>
        </div>
        <a href="{{ route('home') }}" target="_blank" class="text-sm text-blue-600 hover:text-blue-800 font-medium">
            Ver página →
        </a>
    </div>
</div>
@endsection

@extends('layouts.app')

@section('meta_title', 'Patentes | CI Cacau')
@section('meta_description', 'Conheça as patentes relacionadas à cadeia produtiva do cacau. Inovações tecnológicas e propriedade intelectual do setor cacaueiro brasileiro.')

@section('content')
<!-- Hero Section -->
<section class="bg-gradient-to-br from-primary to-secondary text-white py-16 md:py-20">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center">
            <h1 class="text-4xl md:text-5xl font-bold mb-4">
                Patentes
            </h1>
            <p class="text-xl md:text-2xl text-white/90 max-w-3xl mx-auto">
                Inovações e propriedade intelectual relacionadas ao cacau
            </p>
        </div>
    </div>
</section>

<!-- Filtros -->
<section class="py-6 bg-gray-50 border-b">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <form action="{{ route('patentes.index') }}" method="GET" class="flex flex-col md:flex-row gap-4">
            <!-- Busca -->
            <div class="flex-1">
                <input 
                    type="text" 
                    name="busca" 
                    value="{{ request('busca') }}"
                    placeholder="Buscar por título, inventor, número da patente..."
                    class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary focus:border-primary"
                >
            </div>
            
            <!-- Status -->
            <div class="w-full md:w-48">
                <select 
                    name="status" 
                    class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary focus:border-primary"
                >
                    <option value="">Todos os status</option>
                    @foreach($statuses as $key => $label)
                        <option value="{{ $key }}" {{ request('status') == $key ? 'selected' : '' }}>
                            {{ $label }}
                        </option>
                    @endforeach
                </select>
            </div>
            
            <!-- Botão -->
            <button 
                type="submit" 
                class="px-6 py-2 bg-primary text-white rounded-lg hover:bg-opacity-90 transition-all font-medium"
            >
                Filtrar
            </button>
            
            @if(request()->hasAny(['busca', 'status']))
                <a 
                    href="{{ route('patentes.index') }}" 
                    class="px-6 py-2 bg-gray-200 text-gray-700 rounded-lg hover:bg-gray-300 transition-all font-medium text-center"
                >
                    Limpar
                </a>
            @endif
        </form>
    </div>
</section>

<!-- Lista de Patentes -->
<section class="py-12 md:py-16 bg-white">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        @if($patents->count() > 0)
            <!-- Grid de Patentes -->
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6 md:gap-8">
                @foreach($patents as $patent)
                    <article class="bg-white rounded-xl overflow-hidden shadow-lg hover:shadow-2xl transition-all duration-300 group flex flex-col border border-gray-100">
                        <!-- Header com status -->
                        <div class="p-4 bg-gradient-to-r from-primary/10 to-secondary/10 border-b border-gray-100">
                            <div class="flex items-center justify-between">
                                <span class="px-3 py-1 bg-{{ $patent->getStatusColor() }}-100 text-{{ $patent->getStatusColor() }}-800 text-xs font-semibold rounded-full">
                                    {{ $patent->getStatusName() }}
                                </span>
                                @if($patent->patent_number)
                                    <span class="text-sm text-gray-600 font-mono">{{ $patent->patent_number }}</span>
                                @endif
                            </div>
                        </div>

                        <!-- Conteúdo -->
                        <div class="p-6 flex-1 flex flex-col">
                            <!-- Título -->
                            <h2 class="text-lg md:text-xl font-bold text-gray-900 mb-3 group-hover:text-primary transition-colors line-clamp-2">
                                <a href="{{ route('patentes.show', $patent->slug) }}">
                                    {{ $patent->title }}
                                </a>
                            </h2>

                            <!-- Inventores -->
                            <div class="flex items-start gap-2 text-sm text-gray-600 mb-3">
                                <svg class="w-4 h-4 mt-0.5 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9.663 17h4.673M12 3v1m6.364 1.636l-.707.707M21 12h-1M4 12H3m3.343-5.657l-.707-.707m2.828 9.9a5 5 0 117.072 0l-.548.547A3.374 3.374 0 0014 18.469V19a2 2 0 11-4 0v-.531c0-.895-.356-1.754-.988-2.386l-.548-.547z"></path>
                                </svg>
                                <span class="line-clamp-1">{{ $patent->inventors }}</span>
                            </div>

                            <!-- Depositante -->
                            @if($patent->applicant)
                                <div class="flex items-start gap-2 text-sm text-gray-600 mb-3">
                                    <svg class="w-4 h-4 mt-0.5 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"></path>
                                    </svg>
                                    <span class="line-clamp-1">{{ $patent->applicant }}</span>
                                </div>
                            @endif

                            <!-- Resumo -->
                            <p class="text-gray-600 mb-4 line-clamp-3 flex-1 text-sm">
                                {{ $patent->summary }}
                            </p>

                            <!-- Datas -->
                            <div class="flex flex-wrap gap-3 text-xs text-gray-500 mb-4">
                                @if($patent->filing_date)
                                    <span class="flex items-center gap-1">
                                        <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                                        </svg>
                                        Depósito: {{ $patent->getFormattedFilingDate() }}
                                    </span>
                                @endif
                                @if($patent->grant_date)
                                    <span class="flex items-center gap-1">
                                        <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                        </svg>
                                        Concessão: {{ $patent->getFormattedGrantDate() }}
                                    </span>
                                @endif
                            </div>

                            <!-- Ações -->
                            <div class="flex items-center justify-between pt-4 border-t border-gray-200">
                                <div class="flex items-center gap-2">
                                    @if($patent->file)
                                        <a 
                                            href="{{ $patent->getFileUrl() }}" 
                                            target="_blank"
                                            class="inline-flex items-center gap-1 text-primary hover:text-primary/80 text-sm font-medium"
                                            title="Download PDF"
                                        >
                                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 10v6m0 0l-3-3m3 3l3-3m2 8H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                                            </svg>
                                            PDF
                                        </a>
                                    @endif
                                    @if($patent->external_link)
                                        <a 
                                            href="{{ $patent->external_link }}" 
                                            target="_blank"
                                            class="inline-flex items-center gap-1 text-gray-600 hover:text-primary text-sm font-medium"
                                            title="Link externo"
                                        >
                                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14"></path>
                                            </svg>
                                            Link
                                        </a>
                                    @endif
                                </div>

                                <a 
                                    href="{{ route('patentes.show', $patent->slug) }}" 
                                    class="inline-flex items-center gap-2 text-primary font-semibold hover:gap-3 transition-all text-sm"
                                >
                                    Ver mais
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                                    </svg>
                                </a>
                            </div>
                        </div>
                    </article>
                @endforeach
            </div>

            <!-- Paginação -->
            @if($patents->hasPages())
                <div class="mt-12">
                    {{ $patents->links() }}
                </div>
            @endif
        @else
            <!-- Estado Vazio -->
            <div class="text-center py-16">
                <svg class="w-24 h-24 text-gray-400 mx-auto mb-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9.663 17h4.673M12 3v1m6.364 1.636l-.707.707M21 12h-1M4 12H3m3.343-5.657l-.707-.707m2.828 9.9a5 5 0 117.072 0l-.548.547A3.374 3.374 0 0014 18.469V19a2 2 0 11-4 0v-.531c0-.895-.356-1.754-.988-2.386l-.548-.547z"></path>
                </svg>
                <h3 class="text-2xl font-bold text-gray-900 mb-2">Nenhuma patente encontrada</h3>
                <p class="text-gray-600 mb-6">
                    @if(request()->hasAny(['busca', 'status']))
                        Tente ajustar os filtros de busca.
                    @else
                        Em breve publicaremos patentes relacionadas ao cacau.
                    @endif
                </p>
                <a href="{{ route('home') }}" class="inline-flex items-center gap-2 bg-primary text-white px-6 py-3 rounded-lg font-semibold hover:bg-opacity-90 transition-all">
                    Voltar ao Início
                </a>
            </div>
        @endif
    </div>
</section>
@endsection

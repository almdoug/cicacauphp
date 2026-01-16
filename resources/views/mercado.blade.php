@extends('layouts.app')

@section('meta_title', 'Mercado Nacional e Internacional | CI Cacau')
@section('meta_description', 'Dados de produção, preços, exportação e importação do cacau no Brasil e no mundo.')

@section('content')
<!-- Hero Section -->
<section class="bg-gradient-to-br from-primary to-secondary text-white py-16 md:py-20">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center">
            <h1 class="text-4xl md:text-5xl font-bold mb-4">
                Mercado Nacional e Internacional
            </h1>
            <p class="text-xl md:text-2xl text-white/90 max-w-3xl mx-auto">
                Dados de produção, preços, exportação e importação do cacau
            </p>
        </div>
    </div>
</section>

<!-- Filtros -->
<section class="py-4 md:py-6 bg-gray-50 border-b border-gray-200" x-data="{ filtersOpen: false }">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <!-- Botão toggle mobile -->
        <button 
            @click="filtersOpen = !filtersOpen" 
            class="md:hidden w-full flex items-center justify-between px-4 py-3 bg-white rounded-lg border border-gray-300 text-gray-700 font-medium"
        >
            <span class="flex items-center gap-2">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 4a1 1 0 011-1h16a1 1 0 011 1v2.586a1 1 0 01-.293.707l-6.414 6.414a1 1 0 00-.293.707V17l-4 4v-6.586a1 1 0 00-.293-.707L3.293 7.293A1 1 0 013 6.586V4z"></path>
                </svg>
                Filtros
                @if(request()->hasAny(['search']))
                    <span class="px-2 py-0.5 bg-primary text-white text-xs rounded-full">Ativos</span>
                @endif
            </span>
            <svg class="w-5 h-5 transition-transform" :class="{ 'rotate-180': filtersOpen }" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
            </svg>
        </button>

        <!-- Formulário de filtros -->
        <form 
            action="{{ route('mercado.index') }}" 
            method="GET" 
            class="flex-col md:flex-row gap-4 flex-wrap mt-4 md:mt-0" 
            :class="{ 'hidden md:flex': !filtersOpen, 'flex': filtersOpen }"
        >
            <!-- Busca -->
            <div class="flex-1 min-w-[200px]">
                <input 
                    type="text" 
                    name="search" 
                    value="{{ request('search') }}"
                    placeholder="Buscar por título, fonte..."
                    class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary focus:border-primary"
                >
            </div>
            
            <!-- Botão -->
            <button 
                type="submit" 
                class="px-6 py-2 bg-primary text-white rounded-lg hover:bg-opacity-90 transition-all font-medium"
            >
                Filtrar
            </button>
            
            @if(request()->hasAny(['search']))
                <a 
                    href="{{ route('mercado.index') }}" 
                    class="px-6 py-2 bg-gray-200 text-gray-700 rounded-lg hover:bg-gray-300 transition-all font-medium text-center"
                >
                    Limpar
                </a>
            @endif
        </form>
    </div>
</section>

<!-- Lista de Dados de Mercado -->
<section class="py-12 md:py-16 bg-white">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        @if($marketData->count() > 0)
            <!-- Grid de Dados -->
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6 md:gap-8">
                @foreach($marketData as $data)
                    <article class="bg-white rounded-xl overflow-hidden shadow-lg hover:shadow-2xl transition-all duration-300 group flex flex-col border border-gray-100">
                        <!-- Header -->
                        <div class="p-4 bg-gradient-to-r from-primary/10 to-secondary/10 border-b border-gray-100">
                            <div class="flex items-center justify-between">
                                @if($data->location)
                                    <span class="px-3 py-1 bg-primary text-white text-xs font-semibold rounded-full">
                                        {{ $data->location }}
                                    </span>
                                @endif
                                @if($data->frequency)
                                    <span class="text-sm text-gray-600 font-medium">{{ $data->frequency }}</span>
                                @endif
                            </div>
                        </div>

                        <!-- Conteúdo -->
                        <div class="p-6 flex-1 flex flex-col">
                            <!-- Título -->
                            <h2 class="text-lg md:text-xl font-bold text-gray-900 mb-3 group-hover:text-primary transition-colors line-clamp-2">
                                <a href="{{ route('mercado.show', $data->slug) }}">
                                    {{ $data->title }}
                                </a>
                            </h2>

                            <!-- Local -->
                            @if($data->country)
                                <div class="flex items-start gap-2 text-sm text-gray-600 mb-3">
                                   <svg class="w-4 h-4 mt-0.5 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3.055 11H5a2 2 0 012 2v1a2 2 0 002 2 2 2 0 012 2v2.945M8 3.935V5.5A2.5 2.5 0 0010.5 8h.5a2 2 0 012 2 2 2 0 104 0 2 2 0 012-2h1.064M15 20.488V18a2 2 0 012-2h3.064M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                    </svg>
                                    <span class="line-clamp-1">{{ $data->country }}</span>
                                </div>
                            @endif

                            <!-- Unidade -->
                            @if($data->unit)
                                <div class="flex items-start gap-2 text-sm text-gray-600 mb-3">
                                   <svg class="w-4 h-4 mt-0.5 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 21h10a2 2 0 002-2V9.414a1 1 0 00-.293-.707l-5.414-5.414A1 1 0 0012.586 3H7a2 2 0 00-2 2v14a2 2 0 002 2z"></path>
                                    </svg>
                                    <span class="line-clamp-1">{{ $data->unit }}</span>
                                </div>
                            @endif

                             <!-- Fonte -->
                            @if($data->source)
                                <div class="flex items-start gap-2 text-sm text-gray-600 mb-3">
                                    <svg class="w-4 h-4 mt-0.5 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 20H5a2 2 0 01-2-2V6a2 2 0 012-2h10a2 2 0 012 2v1m2 13a2 2 0 01-2-2V7m2 13a2 2 0 002-2V9a2 2 0 00-2-2h-2m-4-3H9M7 16h6M7 8h6v4H7V8z"></path>
                                    </svg>
                                    <span class="line-clamp-1">{{ $data->source }}</span>
                                </div>
                            @endif

                            <!-- Comentário -->
                            @if($data->comment)
                                <p class="text-gray-600 mb-4 line-clamp-3 flex-1 text-sm">
                                    {{ $data->comment }}
                                </p>
                            @endif

                            <!-- Ações -->
                            <div class="flex items-center justify-end pt-4 border-t border-gray-200">
                                <a 
                                    href="{{ route('mercado.show', $data->slug) }}" 
                                    class="inline-flex items-center gap-1 text-primary hover:text-primary/80 font-semibold text-sm transition-colors"
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
            @if($marketData->hasPages())
                <div class="mt-8 md:mt-12">
                    {{ $marketData->withQueryString()->links() }}
                </div>
            @endif
        @else
            <!-- Estado vazio -->
            <div class="text-center py-12">
                <svg class="w-16 h-16 text-gray-400 mx-auto mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 7h6m0 10v-3m-3 3h.01M9 17h.01M9 14h.01M12 14h.01M15 11h.01M12 11h.01M9 11h.01M7 21h10a2 2 0 002-2V5a2 2 0 00-2-2H7a2 2 0 00-2 2v14a2 2 0 002 2z"></path>
                </svg>
                <h3 class="text-xl font-semibold text-gray-900 mb-2">Nenhum dado de mercado encontrado</h3>
                <p class="text-gray-600 mb-4">
                    @if(request()->hasAny(['search']))
                        Tente ajustar os filtros de busca.
                    @else
                        Em breve publicaremos dados de mercado do cacau.
                    @endif
                </p>
                @if(request()->hasAny(['search']))
                    <a href="{{ route('mercado.index') }}" class="inline-flex items-center gap-2 text-primary hover:text-primary/80 font-medium">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path>
                        </svg>
                        Limpar filtros
                    </a>
                @endif
            </div>
        @endif
    </div>
</section>
@endsection

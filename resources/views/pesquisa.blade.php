@extends('layouts.app')

@section('meta_title', 'Pesquisa | CI Cacau')
@section('meta_description', 'Acesse artigos, relatórios, livros e dissertações sobre a cadeia produtiva do cacau. Pesquisa científica e tecnológica do setor cacaueiro.')

@section('content')
<!-- Hero Section -->
<section class="bg-gradient-to-br from-primary to-secondary text-white py-16 md:py-20">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center">
            <h1 class="text-4xl md:text-5xl font-bold mb-4">
                Pesquisa
            </h1>
            <p class="text-xl md:text-2xl text-white/90 max-w-3xl mx-auto">
                Artigos, relatórios, livros e dissertações sobre a cadeia produtiva do cacau
            </p>
        </div>
    </div>
</section>

<!-- Filtros -->
<section class="py-6 bg-gray-50 border-b">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <form action="{{ route('pesquisa.index') }}" method="GET" class="flex flex-col md:flex-row gap-4">
            <!-- Busca -->
            <div class="flex-1">
                <input 
                    type="text" 
                    name="busca" 
                    value="{{ request('busca') }}"
                    placeholder="Buscar por título, autor, palavra-chave..."
                    class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary focus:border-primary"
                >
            </div>
            
            <!-- Tipo -->
            <div class="w-full md:w-48">
                <select 
                    name="tipo" 
                    class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary focus:border-primary"
                >
                    <option value="">Todos os tipos</option>
                    @foreach($types as $key => $label)
                        <option value="{{ $key }}" {{ request('tipo') == $key ? 'selected' : '' }}>
                            {{ $label }}
                        </option>
                    @endforeach
                </select>
            </div>
            
            <!-- Ano -->
            <div class="w-full md:w-36">
                <select 
                    name="ano" 
                    class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary focus:border-primary"
                >
                    <option value="">Todos os anos</option>
                    @foreach($years as $year)
                        <option value="{{ $year }}" {{ request('ano') == $year ? 'selected' : '' }}>
                            {{ $year }}
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
            
            @if(request()->hasAny(['busca', 'tipo', 'ano']))
                <a 
                    href="{{ route('pesquisa.index') }}" 
                    class="px-6 py-2 bg-gray-200 text-gray-700 rounded-lg hover:bg-gray-300 transition-all font-medium text-center"
                >
                    Limpar
                </a>
            @endif
        </form>
    </div>
</section>

<!-- Lista de Pesquisas -->
<section class="py-12 md:py-16 bg-white">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        @if($researches->count() > 0)
            <!-- Grid de Pesquisas -->
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6 md:gap-8">
                @foreach($researches as $research)
                    <article class="bg-white rounded-xl overflow-hidden shadow-lg hover:shadow-2xl transition-all duration-300 group flex flex-col border border-gray-100">
                        <!-- Header com tipo -->
                        <div class="p-4 bg-gradient-to-r from-primary/10 to-secondary/10 border-b border-gray-100">
                            <div class="flex items-center justify-between">
                                <span class="px-3 py-1 bg-primary text-white text-xs font-semibold rounded-full">
                                    {{ $research->getTypeName() }}
                                </span>
                                @if($research->year)
                                    <span class="text-sm text-gray-600 font-medium">{{ $research->year }}</span>
                                @endif
                            </div>
                        </div>

                        <!-- Conteúdo -->
                        <div class="p-6 flex-1 flex flex-col">
                            <!-- Título -->
                            <h2 class="text-lg md:text-xl font-bold text-gray-900 mb-3 group-hover:text-primary transition-colors line-clamp-2">
                                <a href="{{ route('pesquisa.show', $research->slug) }}">
                                    {{ $research->title }}
                                </a>
                            </h2>

                            <!-- Autores -->
                            <div class="flex items-start gap-2 text-sm text-gray-600 mb-3">
                                <svg class="w-4 h-4 mt-0.5 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                                </svg>
                                <span class="line-clamp-1">{{ $research->authors }}</span>
                            </div>

                            <!-- Instituição -->
                            @if($research->institution)
                                <div class="flex items-start gap-2 text-sm text-gray-600 mb-3">
                                    <svg class="w-4 h-4 mt-0.5 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"></path>
                                    </svg>
                                    <span class="line-clamp-1">{{ $research->institution }}</span>
                                </div>
                            @endif

                            <!-- Resumo -->
                            <p class="text-gray-600 mb-4 line-clamp-3 flex-1 text-sm">
                                {{ $research->summary }}
                            </p>

                            <!-- Palavras-chave -->
                            @if($research->keywords)
                                <div class="flex flex-wrap gap-1 mb-4">
                                    @foreach(array_slice($research->getKeywordsArray(), 0, 3) as $keyword)
                                        <span class="px-2 py-1 bg-gray-100 text-gray-600 text-xs rounded">
                                            {{ $keyword }}
                                        </span>
                                    @endforeach
                                </div>
                            @endif

                            <!-- Ações -->
                            <div class="flex items-center justify-between pt-4 border-t border-gray-200">
                                <div class="flex items-center gap-2">
                                    @if($research->file)
                                        <a 
                                            href="{{ $research->getFileUrl() }}" 
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
                                    @if($research->external_link)
                                        <a 
                                            href="{{ $research->external_link }}" 
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
                                    href="{{ route('pesquisa.show', $research->slug) }}" 
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
            @if($researches->hasPages())
                <div class="mt-12">
                    {{ $researches->links() }}
                </div>
            @endif
        @else
            <!-- Estado Vazio -->
            <div class="text-center py-16">
                <svg class="w-24 h-24 text-gray-400 mx-auto mb-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"></path>
                </svg>
                <h3 class="text-2xl font-bold text-gray-900 mb-2">Nenhuma pesquisa encontrada</h3>
                <p class="text-gray-600 mb-6">
                    @if(request()->hasAny(['busca', 'tipo', 'ano']))
                        Tente ajustar os filtros de busca.
                    @else
                        Em breve publicaremos pesquisas sobre o setor cacaueiro.
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

@extends('layouts.app')

@section('meta_title', $research->title . ' | Pesquisa | CI Cacau')
@section('meta_description', Str::limit($research->summary, 160))

@section('content')
<!-- Hero Section -->
<section class="bg-gradient-to-br from-primary to-secondary text-white py-12 md:py-16">
    <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center">
            <span class="inline-block px-4 py-1 bg-white/20 rounded-full text-sm font-semibold mb-4">
                {{ $research->getTypeName() }}
            </span>
            <h1 class="text-3xl md:text-4xl font-bold mb-4">
                {{ $research->title }}
            </h1>
            <p class="text-lg text-white/90">
                {{ $research->authors }}
            </p>
        </div>
    </div>
</section>

<!-- Conteúdo -->
<section class="py-12 md:py-16">
    <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="bg-white rounded-xl shadow-lg overflow-hidden">
            <!-- Meta informações -->
            <div class="p-6 bg-gray-50 border-b border-gray-200">
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    @if($research->institution)
                        <div class="flex items-center gap-3">
                            <div class="w-10 h-10 bg-primary/10 rounded-lg flex items-center justify-center">
                                <svg class="w-5 h-5 text-primary" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"></path>
                                </svg>
                            </div>
                            <div>
                                <p class="text-xs text-gray-500 uppercase tracking-wider">Instituição</p>
                                <p class="text-sm font-medium text-gray-900">{{ $research->institution }}</p>
                            </div>
                        </div>
                    @endif
                    
                    @if($research->year)
                        <div class="flex items-center gap-3">
                            <div class="w-10 h-10 bg-primary/10 rounded-lg flex items-center justify-center">
                                <svg class="w-5 h-5 text-primary" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                                </svg>
                            </div>
                            <div>
                                <p class="text-xs text-gray-500 uppercase tracking-wider">Ano</p>
                                <p class="text-sm font-medium text-gray-900">{{ $research->year }}</p>
                            </div>
                        </div>
                    @endif
                    
                    @if($research->doi)
                        <div class="flex items-center gap-3">
                            <div class="w-10 h-10 bg-primary/10 rounded-lg flex items-center justify-center">
                                <svg class="w-5 h-5 text-primary" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13.828 10.172a4 4 0 00-5.656 0l-4 4a4 4 0 105.656 5.656l1.102-1.101m-.758-4.899a4 4 0 005.656 0l4-4a4 4 0 00-5.656-5.656l-1.1 1.1"></path>
                                </svg>
                            </div>
                            <div>
                                <p class="text-xs text-gray-500 uppercase tracking-wider">DOI</p>
                                <p class="text-sm font-medium text-gray-900">{{ $research->doi }}</p>
                            </div>
                        </div>
                    @endif
                    
                    <div class="flex items-center gap-3">
                        <div class="w-10 h-10 bg-primary/10 rounded-lg flex items-center justify-center">
                            <svg class="w-5 h-5 text-primary" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A1.994 1.994 0 013 12V7a4 4 0 014-4z"></path>
                            </svg>
                        </div>
                        <div>
                            <p class="text-xs text-gray-500 uppercase tracking-wider">Tipo</p>
                            <p class="text-sm font-medium text-gray-900">{{ $research->getTypeName() }}</p>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Resumo -->
            <div class="p-6 md:p-8">
                <h2 class="text-xl font-bold text-gray-900 mb-4">Resumo</h2>
                <div class="prose prose-lg max-w-none text-gray-700">
                    {{ $research->summary }}
                </div>

                <!-- Palavras-chave -->
                @if($research->keywords)
                    <div class="mt-8">
                        <h3 class="text-lg font-semibold text-gray-900 mb-3">Palavras-chave</h3>
                        <div class="flex flex-wrap gap-2">
                            @foreach($research->getKeywordsArray() as $keyword)
                                <span class="px-3 py-1 bg-primary/10 text-primary text-sm font-medium rounded-full">
                                    {{ $keyword }}
                                </span>
                            @endforeach
                        </div>
                    </div>
                @endif

                <!-- Ações -->
                <div class="mt-8 pt-6 border-t border-gray-200 flex flex-wrap gap-4">
                    @if($research->file)
                        <a 
                            href="{{ $research->getFileUrl() }}" 
                            target="_blank"
                            class="inline-flex items-center gap-2 bg-primary text-white px-6 py-3 rounded-lg font-semibold hover:bg-opacity-90 transition-all"
                        >
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 10v6m0 0l-3-3m3 3l3-3m2 8H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                            </svg>
                            Baixar PDF
                        </a>
                    @endif
                    
                    @if($research->external_link)
                        <a 
                            href="{{ $research->external_link }}" 
                            target="_blank"
                            class="inline-flex items-center gap-2 bg-gray-100 text-gray-700 px-6 py-3 rounded-lg font-semibold hover:bg-gray-200 transition-all"
                        >
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14"></path>
                            </svg>
                            Acessar Link Externo
                        </a>
                    @endif
                </div>
            </div>
        </div>

        <!-- Voltar -->
        <div class="mt-8">
            <a 
                href="{{ route('pesquisa.index') }}" 
                class="inline-flex items-center gap-2 text-gray-600 hover:text-primary transition-colors"
            >
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"></path>
                </svg>
                Voltar para Pesquisas
            </a>
        </div>
    </div>
</section>

<!-- Pesquisas Relacionadas -->
@if($relatedResearches->count() > 0)
<section class="py-12 bg-gray-50">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <h2 class="text-2xl font-bold text-gray-900 mb-8">Pesquisas Relacionadas</h2>
        
        <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
            @foreach($relatedResearches as $related)
                <article class="bg-white rounded-lg shadow-md hover:shadow-lg transition-shadow p-6">
                    <span class="inline-block px-3 py-1 bg-primary/10 text-primary text-xs font-semibold rounded-full mb-3">
                        {{ $related->getTypeName() }}
                    </span>
                    <h3 class="text-lg font-bold text-gray-900 mb-2 line-clamp-2">
                        <a href="{{ route('pesquisa.show', $related->slug) }}" class="hover:text-primary transition-colors">
                            {{ $related->title }}
                        </a>
                    </h3>
                    <p class="text-sm text-gray-600 line-clamp-1 mb-3">{{ $related->authors }}</p>
                    <a 
                        href="{{ route('pesquisa.show', $related->slug) }}" 
                        class="text-primary font-semibold text-sm hover:underline"
                    >
                        Ver mais →
                    </a>
                </article>
            @endforeach
        </div>
    </div>
</section>
@endif
@endsection

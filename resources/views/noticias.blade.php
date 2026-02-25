@extends('layouts.app')

@section('meta_title', 'Notícias | CI Cacau')
@section('meta_description', 'Acompanhe as últimas notícias sobre o setor cacaueiro brasileiro. Informações atualizadas sobre mercado, tecnologia, eventos e muito mais.')

@section('content')
<!-- Hero Section -->
<section class="bg-gradient-to-br from-primary to-secondary text-white py-16 md:py-20">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center">
            <h1 class="text-4xl md:text-5xl font-bold mb-4">
                Notícias do Cacau
            </h1>
            <p class="text-xl md:text-2xl text-white/90 max-w-3xl mx-auto">
                Fique por dentro das últimas novidades sobre a cadeia produtiva do cacau
            </p>
        </div>
    </div>
</section>

<!-- Notícias -->
<section class="py-12 md:py-16 bg-white">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        @if($news->count() > 0)
            <!-- Grid de Notícias -->
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6 md:gap-8">
                @foreach($news as $item)
                    <article class="bg-white rounded-xl overflow-hidden shadow-lg hover:shadow-2xl transition-all duration-300 group flex flex-col">
                        <!-- Imagem -->
                        <a href="{{ route('noticias.show', $item->slug) }}" class="block overflow-hidden">
                            @if($item->image)
                                <img 
                                    src="{{ $item->getImageUrl() }}" 
                                    alt="{{ $item->title }}" 
                                    class="w-full h-48 md:h-56 object-cover group-hover:scale-105 transition-transform duration-300"
                                >
                            @else
                                <div class="w-full h-48 md:h-56 bg-gradient-to-br from-primary to-secondary flex items-center justify-center">
                                    <svg class="w-20 h-20 text-white/50" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 20H5a2 2 0 01-2-2V6a2 2 0 012-2h10a2 2 0 012 2v1m2 13a2 2 0 01-2-2V7m2 13a2 2 0 002-2V9a2 2 0 00-2-2h-2m-4-3H9M7 16h6M7 8h6v4H7V8z"></path>
                                    </svg>
                                </div>
                            @endif
                        </a>

                        <!-- Conteúdo -->
                        <div class="p-6 flex-1 flex flex-col">
                            <!-- Meta Info -->
                            <div class="flex items-center gap-3 text-sm text-gray-600 mb-3">
                                <div class="flex items-center gap-1">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                                    </svg>
                                    <span>{{ $item->getFormattedDate() }}</span>
                                </div>
                                
                                @if($item->source)
                                    <span class="text-gray-400">•</span>
                                    <div class="flex items-center gap-1">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13.828 10.172a4 4 0 00-5.656 0l-4 4a4 4 0 105.656 5.656l1.102-1.101m-.758-4.899a4 4 0 005.656 0l4-4a4 4 0 00-5.656-5.656l-1.1 1.1"></path>
                                        </svg>
                                        @if($item->source_url)
                                            <a href="{{ $item->source_url }}" target="_blank" rel="noopener noreferrer"
                                               class="text-primary hover:underline font-medium inline-flex items-center gap-1"
                                               title="Acessar fonte original">
                                                {{ $item->source }}
                                                <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14"></path>
                                                </svg>
                                            </a>
                                        @else
                                            <span>{{ $item->source }}</span>
                                        @endif
                                    </div>
                                @endif
                            </div>

                            <!-- Título -->
                            <h2 class="text-xl md:text-2xl font-bold text-gray-900 mb-3 group-hover:text-primary transition-colors line-clamp-2">
                                <a href="{{ route('noticias.show', $item->slug) }}">
                                    {{ $item->title }}
                                </a>
                            </h2>

                            <!-- Resumo -->
                            <p class="text-gray-600 mb-4 line-clamp-3 flex-1">
                                {{ $item->summary }}
                            </p>

                            <!-- Autor e Link -->
                            <div class="flex items-center justify-between pt-4 border-t border-gray-200">
                                <div class="flex items-center gap-2 text-sm text-gray-600">
                                    <div class="w-8 h-8 bg-primary rounded-full flex items-center justify-center text-white font-semibold text-xs">
                                        {{ substr($item->user->name, 0, 1) }}
                                    </div>
                                    <span>{{ $item->user->name }}</span>
                                </div>

                                <a 
                                    href="{{ route('noticias.show', $item->slug) }}" 
                                    class="inline-flex items-center gap-2 text-primary font-semibold hover:gap-3 transition-all text-sm"
                                >
                                    Ler mais
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
            @if($news->hasPages())
                <div class="mt-12">
                    {{ $news->links() }}
                </div>
            @endif
        @else
            <!-- Estado Vazio -->
            <div class="text-center py-16">
                <svg class="w-24 h-24 text-gray-400 mx-auto mb-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 20H5a2 2 0 01-2-2V6a2 2 0 012-2h10a2 2 0 012 2v1m2 13a2 2 0 01-2-2V7m2 13a2 2 0 002-2V9a2 2 0 00-2-2h-2m-4-3H9M7 16h6M7 8h6v4H7V8z"></path>
                </svg>
                <h3 class="text-2xl font-bold text-gray-900 mb-2">Nenhuma notícia disponível</h3>
                <p class="text-gray-600 mb-6">Em breve publicaremos novidades sobre o setor cacaueiro.</p>
                <a href="{{ route('home') }}" class="inline-flex items-center gap-2 bg-primary text-white px-6 py-3 rounded-lg font-semibold hover:bg-opacity-90 transition-all">
                    Voltar ao Início
                </a>
            </div>
        @endif
    </div>
</section>
@endsection

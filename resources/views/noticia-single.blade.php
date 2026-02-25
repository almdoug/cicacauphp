@extends('layouts.app')

@section('meta_title', $newsItem->title . ' | CI Cacau')
@section('meta_description', $newsItem->summary)

@section('content')
<!-- Hero/Header -->
<section class="bg-gradient-to-br from-gray-900 to-gray-800 text-white py-12 md:py-16">
    <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="mb-6">
            <a href="{{ route('noticias.index') }}" class="inline-flex items-center gap-2 text-white/80 hover:text-white transition-colors text-sm">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"></path>
                </svg>
                Voltar para notícias
            </a>
        </div>

        <h1 class="text-3xl md:text-4xl lg:text-5xl font-bold mb-6 leading-tight">
            {{ $newsItem->title }}
        </h1>

        <div class="flex flex-wrap items-center gap-4 md:gap-6 text-sm md:text-base text-white/80">
            <div class="flex items-center gap-2">
                <div class="w-10 h-10 bg-primary rounded-full flex items-center justify-center text-white font-semibold">
                    {{ substr($newsItem->user->name, 0, 1) }}
                </div>
                <div>
                    <p class="font-medium text-white">{{ $newsItem->user->name }}</p>
                    <p class="text-xs text-white/60">Autor</p>
                </div>
            </div>

            <div class="flex items-center gap-2">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                </svg>
                <span>{{ $newsItem->getFormattedDate() }}</span>
            </div>

            @if($newsItem->source)
                <div class="flex items-center gap-2">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13.828 10.172a4 4 0 00-5.656 0l-4 4a4 4 0 105.656 5.656l1.102-1.101m-.758-4.899a4 4 0 005.656 0l4-4a4 4 0 00-5.656-5.656l-1.1 1.1"></path>
                    </svg>
                    @if($newsItem->source_url)
                        <a href="{{ $newsItem->source_url }}" target="_blank" rel="noopener noreferrer"
                           class="hover:underline font-medium inline-flex items-center gap-1 text-white/90 hover:text-white"
                           title="Acessar fonte original">
                            {{ $newsItem->source }}
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14"></path>
                            </svg>
                        </a>
                    @else
                        <span>{{ $newsItem->source }}</span>
                    @endif
                </div>
            @endif
        </div>
    </div>
</section>

<!-- Conteúdo Principal -->
<article class="py-12 md:py-16 bg-white">
    <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">
        <!-- Imagem Principal -->
        @if($newsItem->image)
            <div class="mb-8 md:mb-12 rounded-2xl overflow-hidden shadow-2xl">
                <img 
                    src="{{ $newsItem->getImageUrl() }}" 
                    alt="{{ $newsItem->title }}" 
                    class="w-full h-auto"
                >
            </div>
        @endif

        <!-- Resumo -->
        <div class="mb-8 p-6 bg-gradient-to-br from-primary/5 to-secondary/5 rounded-xl border-l-4 border-primary">
            <p class="text-lg md:text-xl text-gray-800 leading-relaxed font-medium">
                {{ $newsItem->summary }}
            </p>
        </div>

        <!-- Conteúdo -->
        <div class="prose prose-lg max-w-none">
            <div class="text-gray-700 leading-relaxed space-y-4">
                {!! nl2br(e($newsItem->content)) !!}
            </div>
        </div>

        <!-- Informações Adicionais -->
        <div class="mt-12 pt-8 border-t border-gray-200">
            <div class="flex flex-wrap items-center justify-between gap-4">
                <div class="text-sm text-gray-600">
                    <p><strong>Publicado em:</strong> {{ $newsItem->getFormattedDateTime() }}</p>
                    @if($newsItem->updated_at->ne($newsItem->created_at))
                        <p><strong>Atualizado em:</strong> {{ $newsItem->updated_at->format('d/m/Y H:i') }}</p>
                    @endif
                </div>

                <!-- Compartilhar -->
                <div class="flex items-center gap-3">
                    <span class="text-sm text-gray-600 font-medium">Compartilhar:</span>
                    <div class="flex gap-2">
                        <a 
                            href="https://www.facebook.com/sharer/sharer.php?u={{ urlencode(route('noticias.show', $newsItem->slug)) }}" 
                            target="_blank"
                            class="w-10 h-10 bg-blue-600 text-white rounded-full flex items-center justify-center hover:bg-blue-700 transition-colors"
                            title="Compartilhar no Facebook"
                        >
                            <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24">
                                <path d="M24 12.073c0-6.627-5.373-12-12-12s-12 5.373-12 12c0 5.99 4.388 10.954 10.125 11.854v-8.385H7.078v-3.47h3.047V9.43c0-3.007 1.792-4.669 4.533-4.669 1.312 0 2.686.235 2.686.235v2.953H15.83c-1.491 0-1.956.925-1.956 1.874v2.25h3.328l-.532 3.47h-2.796v8.385C19.612 23.027 24 18.062 24 12.073z"/>
                            </svg>
                        </a>

                        <a 
                            href="https://twitter.com/intent/tweet?url={{ urlencode(route('noticias.show', $newsItem->slug)) }}&text={{ urlencode($newsItem->title) }}" 
                            target="_blank"
                            class="w-10 h-10 bg-sky-500 text-white rounded-full flex items-center justify-center hover:bg-sky-600 transition-colors"
                            title="Compartilhar no Twitter"
                        >
                            <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24">
                                <path d="M23.953 4.57a10 10 0 01-2.825.775 4.958 4.958 0 002.163-2.723c-.951.555-2.005.959-3.127 1.184a4.92 4.92 0 00-8.384 4.482C7.69 8.095 4.067 6.13 1.64 3.162a4.822 4.822 0 00-.666 2.475c0 1.71.87 3.213 2.188 4.096a4.904 4.904 0 01-2.228-.616v.06a4.923 4.923 0 003.946 4.827 4.996 4.996 0 01-2.212.085 4.936 4.936 0 004.604 3.417 9.867 9.867 0 01-6.102 2.105c-.39 0-.779-.023-1.17-.067a13.995 13.995 0 007.557 2.209c9.053 0 13.998-7.496 13.998-13.985 0-.21 0-.42-.015-.63A9.935 9.935 0 0024 4.59z"/>
                            </svg>
                        </a>

                        <a 
                            href="https://api.whatsapp.com/send?text={{ urlencode($newsItem->title . ' - ' . route('noticias.show', $newsItem->slug)) }}" 
                            target="_blank"
                            class="w-10 h-10 bg-green-600 text-white rounded-full flex items-center justify-center hover:bg-green-700 transition-colors"
                            title="Compartilhar no WhatsApp"
                        >
                            <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24">
                                <path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347m-5.421 7.403h-.004a9.87 9.87 0 01-5.031-1.378l-.361-.214-3.741.982.998-3.648-.235-.374a9.86 9.86 0 01-1.51-5.26c.001-5.45 4.436-9.884 9.888-9.884 2.64 0 5.122 1.03 6.988 2.898a9.825 9.825 0 012.893 6.994c-.003 5.45-4.437 9.884-9.885 9.884m8.413-18.297A11.815 11.815 0 0012.05 0C5.495 0 .16 5.335.157 11.892c0 2.096.547 4.142 1.588 5.945L.057 24l6.305-1.654a11.882 11.882 0 005.683 1.448h.005c6.554 0 11.89-5.335 11.893-11.893a11.821 11.821 0 00-3.48-8.413Z"/>
                            </svg>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</article>

<!-- Notícias Relacionadas -->
@if($relatedNews->count() > 0)
    <section class="py-12 md:py-16 bg-gradient-to-br from-gray-50 to-white">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center mb-10">
                <h2 class="text-3xl md:text-4xl font-bold text-gray-900 mb-4">
                    Notícias Relacionadas
                </h2>
                <p class="text-lg text-gray-600">
                    Continue lendo sobre o setor cacaueiro
                </p>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-3 gap-6 md:gap-8">
                @foreach($relatedNews as $item)
                    <article class="bg-white rounded-xl overflow-hidden shadow-lg hover:shadow-2xl transition-all duration-300 group">
                        <a href="{{ route('noticias.show', $item->slug) }}" class="block overflow-hidden">
                            @if($item->image)
                                <img 
                                    src="{{ $item->getImageUrl() }}" 
                                    alt="{{ $item->title }}" 
                                    class="w-full h-48 object-cover group-hover:scale-105 transition-transform duration-300"
                                >
                            @else
                                <div class="w-full h-48 bg-gradient-to-br from-primary to-secondary flex items-center justify-center">
                                    <svg class="w-16 h-16 text-white/50" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 20H5a2 2 0 01-2-2V6a2 2 0 012-2h10a2 2 0 012 2v1m2 13a2 2 0 01-2-2V7m2 13a2 2 0 002-2V9a2 2 0 00-2-2h-2m-4-3H9M7 16h6M7 8h6v4H7V8z"></path>
                                    </svg>
                                </div>
                            @endif
                        </a>

                        <div class="p-6">
                            <p class="text-sm text-gray-600 mb-2">{{ $item->getFormattedDate() }}</p>
                            <h3 class="text-lg font-bold text-gray-900 mb-3 group-hover:text-primary transition-colors line-clamp-2">
                                <a href="{{ route('noticias.show', $item->slug) }}">
                                    {{ $item->title }}
                                </a>
                            </h3>
                            <p class="text-gray-600 mb-4 line-clamp-2">
                                {{ $item->summary }}
                            </p>
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
                    </article>
                @endforeach
            </div>

            <div class="text-center mt-10">
                <a 
                    href="{{ route('noticias.index') }}" 
                    class="inline-flex items-center gap-2 bg-primary text-white px-8 py-4 rounded-lg font-semibold hover:bg-opacity-90 transition-all shadow-lg hover:shadow-xl"
                >
                    Ver Todas as Notícias
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7l5 5m0 0l-5 5m5-5H6"></path>
                    </svg>
                </a>
            </div>
        </div>
    </section>
@endif
@endsection

@extends('layouts.app')

@section('meta_title', $cost->title . ' | Custos de Produção | CI Cacau')
@section('meta_description', Str::limit($cost->summary, 160))

@section('content')
<!-- Hero Section -->
<section class="bg-gradient-to-br from-primary to-secondary text-white py-12 md:py-16">
    <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center">
            <div class="flex items-center justify-center gap-3 mb-4 flex-wrap">
                <span class="inline-block px-4 py-1 bg-white/20 rounded-full text-sm font-semibold">
                    {{ $cost->getTypeName() }}
                </span>
                @if($cost->region)
                    <span class="inline-block px-4 py-1 bg-white/20 rounded-full text-sm font-semibold">
                        {{ $cost->region }}
                    </span>
                @endif
                @if($cost->period)
                    <span class="inline-block px-4 py-1 bg-white/20 rounded-full text-sm font-semibold">
                        {{ $cost->period }}
                    </span>
                @endif
            </div>
            <h1 class="text-3xl md:text-4xl font-bold mb-4">
                {{ $cost->title }}
            </h1>
            @if($cost->value)
                <p class="text-2xl md:text-3xl text-white/90 font-bold">
                    {{ $cost->getFormattedValue() }}
                </p>
            @endif
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
                    <div class="flex items-center gap-3">
                        <div class="w-10 h-10 bg-primary/10 rounded-lg flex items-center justify-center">
                            <svg class="w-5 h-5 text-primary" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                            </svg>
                        </div>
                        <div>
                            <p class="text-xs text-gray-500 uppercase tracking-wider">Data de Publicação</p>
                            <p class="text-sm font-medium text-gray-900">{{ $cost->getFormattedPublishedAt() }}</p>
                        </div>
                    </div>
                    
                    @if($cost->source)
                        <div class="flex items-center gap-3">
                            <div class="w-10 h-10 bg-primary/10 rounded-lg flex items-center justify-center">
                                <svg class="w-5 h-5 text-primary" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 20H5a2 2 0 01-2-2V6a2 2 0 012-2h10a2 2 0 012 2v1m2 13a2 2 0 01-2-2V7m2 13a2 2 0 002-2V9a2 2 0 00-2-2h-2m-4-3H9M7 16h6M7 8h6v4H7V8z"></path>
                                </svg>
                            </div>
                            <div>
                                <p class="text-xs text-gray-500 uppercase tracking-wider">Fonte</p>
                                <p class="text-sm font-medium text-gray-900">{{ $cost->source }}</p>
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
                            <p class="text-sm font-medium text-gray-900">{{ $cost->getTypeName() }}</p>
                        </div>
                    </div>
                    
                    @if($cost->region)
                        <div class="flex items-center gap-3">
                            <div class="w-10 h-10 bg-primary/10 rounded-lg flex items-center justify-center">
                                <svg class="w-5 h-5 text-primary" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path>
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                </svg>
                            </div>
                            <div>
                                <p class="text-xs text-gray-500 uppercase tracking-wider">Região</p>
                                <p class="text-sm font-medium text-gray-900">{{ $cost->region }}</p>
                            </div>
                        </div>
                    @endif
                </div>
            </div>

            <!-- Resumo e Conteúdo -->
            <div class="p-6 md:p-8">
                <h2 class="text-xl font-bold text-gray-900 mb-4">Resumo</h2>
                <div class="prose prose-lg max-w-none text-gray-700 mb-6">
                    {{ $cost->summary }}
                </div>

                @if($cost->content)
                    <h2 class="text-xl font-bold text-gray-900 mb-4 mt-8">Detalhes</h2>
                    <div class="prose prose-lg max-w-none text-gray-700">
                        {!! nl2br(e($cost->content)) !!}
                    </div>
                @endif

                <!-- Ações -->
                <div class="mt-8 pt-6 border-t border-gray-200 flex flex-wrap gap-4">
                    @if($cost->file)
                        <a 
                            href="{{ $cost->getFileUrl() }}" 
                            target="_blank"
                            class="inline-flex items-center gap-2 bg-primary text-white px-6 py-3 rounded-lg font-semibold hover:bg-opacity-90 transition-all"
                        >
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 10v6m0 0l-3-3m3 3l3-3m2 8H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                            </svg>
                            Baixar Arquivo
                        </a>
                    @endif
                    @if($cost->external_link)
                        <a 
                            href="{{ $cost->external_link }}" 
                            target="_blank" 
                            rel="noopener noreferrer"
                            class="inline-flex items-center gap-2 bg-secondary text-white px-6 py-3 rounded-lg font-semibold hover:bg-opacity-90 transition-all"
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

        <!-- Relacionados -->
        @if($related->count() > 0)
            <div class="mt-12">
                <h3 class="text-2xl font-bold text-gray-900 mb-6">Custos Relacionados</h3>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    @foreach($related as $item)
                        <a href="{{ route('custos.show', $item->slug) }}" class="block group">
                            <div class="bg-white rounded-xl shadow-md p-6 hover:shadow-lg transition-shadow">
                                <span class="inline-block px-3 py-1 text-xs font-semibold rounded-full bg-primary/10 text-primary mb-3">
                                    {{ $item->getTypeName() }}
                                </span>
                                <h4 class="font-semibold text-gray-900 group-hover:text-primary transition-colors line-clamp-2 mb-2">
                                    {{ $item->title }}
                                </h4>
                                @if($item->value)
                                    <p class="text-lg text-green-600 font-bold">{{ $item->getFormattedValue() }}</p>
                                @endif
                            </div>
                        </a>
                    @endforeach
                </div>
            </div>
        @endif

        <!-- Voltar -->
        <div class="mt-8 text-center">
            <a href="{{ route('custos.index') }}" class="inline-flex items-center gap-2 text-primary hover:text-secondary transition-colors font-medium">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path>
                </svg>
                Voltar para Custos de Produção
            </a>
        </div>
    </div>
</section>
@endsection

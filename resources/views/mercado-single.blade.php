@extends('layouts.app')

@section('meta_title', $data->title . ' | Mercado | CI Cacau')
@section('meta_description', Str::limit($data->summary, 160))

@section('content')
<!-- Hero Section -->
<section class="bg-gradient-to-br from-primary to-secondary text-white py-12 md:py-16">
    <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center">
            <div class="flex items-center justify-center gap-3 mb-4 flex-wrap">
                <span class="inline-block px-4 py-1 bg-white/20 rounded-full text-sm font-semibold">
                    {{ $data->getCategoryName() }}
                </span>
                <span class="inline-block px-4 py-1 bg-white/20 rounded-full text-sm font-semibold">
                    {{ $data->getScopeName() }}
                </span>
                @if($data->region)
                    <span class="inline-block px-4 py-1 bg-white/20 rounded-full text-sm font-semibold">
                        {{ $data->region }}
                    </span>
                @endif
            </div>
            <h1 class="text-3xl md:text-4xl font-bold mb-4">
                {{ $data->title }}
            </h1>
            @if($data->value || $data->variation !== null)
                <div class="flex items-center justify-center gap-4 flex-wrap">
                    @if($data->value)
                        <span class="text-2xl md:text-3xl text-white/90 font-bold">
                            {{ $data->getFormattedValue() }}
                        </span>
                    @endif
                    @if($data->variation !== null)
                        <span class="inline-flex items-center gap-1 px-4 py-2 rounded-full text-lg font-bold {{ $data->isVariationPositive() ? 'bg-green-500/30 text-green-100' : 'bg-red-500/30 text-red-100' }}">
                            @if($data->isVariationPositive())
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 10l7-7m0 0l7 7m-7-7v18"></path>
                                </svg>
                            @else
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 14l-7 7m0 0l-7-7m7 7V3"></path>
                                </svg>
                            @endif
                            {{ $data->getFormattedVariation() }}
                        </span>
                    @endif
                </div>
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
                            <p class="text-sm font-medium text-gray-900">{{ $data->getFormattedPublishedAt() }}</p>
                        </div>
                    </div>
                    
                    @if($data->source)
                        <div class="flex items-center gap-3">
                            <div class="w-10 h-10 bg-primary/10 rounded-lg flex items-center justify-center">
                                <svg class="w-5 h-5 text-primary" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 20H5a2 2 0 01-2-2V6a2 2 0 012-2h10a2 2 0 012 2v1m2 13a2 2 0 01-2-2V7m2 13a2 2 0 002-2V9a2 2 0 00-2-2h-2m-4-3H9M7 16h6M7 8h6v4H7V8z"></path>
                                </svg>
                            </div>
                            <div>
                                <p class="text-xs text-gray-500 uppercase tracking-wider">Fonte</p>
                                <p class="text-sm font-medium text-gray-900">{{ $data->source }}</p>
                            </div>
                        </div>
                    @endif
                    
                    <div class="flex items-center gap-3">
                        <div class="w-10 h-10 bg-{{ $data->getCategoryColor() }}-100 rounded-lg flex items-center justify-center">
                            <svg class="w-5 h-5 text-{{ $data->getCategoryColor() }}-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A1.994 1.994 0 013 12V7a4 4 0 014-4z"></path>
                            </svg>
                        </div>
                        <div>
                            <p class="text-xs text-gray-500 uppercase tracking-wider">Categoria</p>
                            <p class="text-sm font-medium text-gray-900">{{ $data->getCategoryName() }}</p>
                        </div>
                    </div>
                    
                    <div class="flex items-center gap-3">
                        <div class="w-10 h-10 bg-primary/10 rounded-lg flex items-center justify-center">
                            <svg class="w-5 h-5 text-primary" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3.055 11H5a2 2 0 012 2v1a2 2 0 002 2 2 2 0 012 2v2.945M8 3.935V5.5A2.5 2.5 0 0010.5 8h.5a2 2 0 012 2 2 2 0 104 0 2 2 0 012-2h1.064M15 20.488V18a2 2 0 012-2h3.064M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                            </svg>
                        </div>
                        <div>
                            <p class="text-xs text-gray-500 uppercase tracking-wider">Escopo</p>
                            <p class="text-sm font-medium text-gray-900">{{ $data->getScopeName() }}</p>
                        </div>
                    </div>
                </div>

                @if($data->period)
                    <div class="mt-4 pt-4 border-t border-gray-200">
                        <div class="flex items-center gap-3">
                            <div class="w-10 h-10 bg-secondary/10 rounded-lg flex items-center justify-center">
                                <svg class="w-5 h-5 text-secondary" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                </svg>
                            </div>
                            <div>
                                <p class="text-xs text-gray-500 uppercase tracking-wider">Período de Referência</p>
                                <p class="text-sm font-medium text-gray-900">{{ $data->period }}</p>
                            </div>
                        </div>
                    </div>
                @endif
            </div>

            <!-- Resumo e Conteúdo -->
            <div class="p-6 md:p-8">
                <h2 class="text-xl font-bold text-gray-900 mb-4">Resumo</h2>
                <div class="prose prose-lg max-w-none text-gray-700 mb-6">
                    {{ $data->summary }}
                </div>

                @if($data->content)
                    <h2 class="text-xl font-bold text-gray-900 mb-4 mt-8">Detalhes</h2>
                    <div class="prose prose-lg max-w-none text-gray-700">
                        {!! nl2br(e($data->content)) !!}
                    </div>
                @endif

                <!-- Ações -->
                <div class="mt-8 pt-6 border-t border-gray-200 flex flex-wrap gap-4">
                    @if($data->file)
                        <a 
                            href="{{ $data->getFileUrl() }}" 
                            target="_blank"
                            class="inline-flex items-center gap-2 bg-primary text-white px-6 py-3 rounded-lg font-semibold hover:bg-opacity-90 transition-all"
                        >
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 10v6m0 0l-3-3m3 3l3-3m2 8H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                            </svg>
                            Baixar Arquivo
                        </a>
                    @endif
                    @if($data->external_link)
                        <a 
                            href="{{ $data->external_link }}" 
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
                <h3 class="text-2xl font-bold text-gray-900 mb-6">Dados Relacionados</h3>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    @foreach($related as $item)
                        <a href="{{ route('mercado.show', $item->slug) }}" class="block group">
                            <div class="bg-white rounded-xl shadow-md p-6 hover:shadow-lg transition-shadow">
                                <div class="flex items-center gap-2 mb-3">
                                    <span class="inline-block px-3 py-1 text-xs font-semibold rounded-full bg-{{ $item->getCategoryColor() }}-100 text-{{ $item->getCategoryColor() }}-700">
                                        {{ $item->getCategoryName() }}
                                    </span>
                                </div>
                                <h4 class="font-semibold text-gray-900 group-hover:text-primary transition-colors line-clamp-2 mb-2">
                                    {{ $item->title }}
                                </h4>
                                @if($item->variation !== null)
                                    <p class="text-lg font-bold {{ $item->isVariationPositive() ? 'text-green-600' : 'text-red-600' }}">
                                        {{ $item->getFormattedVariation() }}
                                    </p>
                                @endif
                            </div>
                        </a>
                    @endforeach
                </div>
            </div>
        @endif

        <!-- Voltar -->
        <div class="mt-8 text-center">
            <a href="{{ route('mercado.index') }}" class="inline-flex items-center gap-2 text-primary hover:text-secondary transition-colors font-medium">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path>
                </svg>
                Voltar para Mercado
            </a>
        </div>
    </div>
</section>
@endsection

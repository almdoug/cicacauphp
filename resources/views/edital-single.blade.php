@extends('layouts.app')

@section('meta_title', $publicNotice->title . ' | Editais | CI Cacau')
@section('meta_description', Str::limit($publicNotice->summary, 160))

@section('content')
<!-- Hero Section -->
<section class="bg-gradient-to-br from-primary to-secondary text-white py-12 md:py-16">
    <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center">
            <div class="flex items-center justify-center gap-3 mb-4">
                <span class="inline-block px-4 py-1 bg-white/20 rounded-full text-sm font-semibold">
                    {{ $publicNotice->getTypeName() }}
                </span>
                <span class="inline-block px-4 py-1 bg-white/20 rounded-full text-sm font-semibold">
                    {{ $publicNotice->getStatusName() }}
                </span>
            </div>
            <h1 class="text-3xl md:text-4xl font-bold mb-4">
                {{ $publicNotice->title }}
            </h1>
            <p class="text-lg text-white/90">
                {{ $publicNotice->institution }}
            </p>
        </div>
    </div>
</section>

<!-- Alerta de prazo -->
@if($publicNotice->deadline && $publicNotice->isOpen())
    @php $days = $publicNotice->getDaysRemaining(); @endphp
    <div class="bg-{{ $days <= 7 ? 'red' : 'green' }}-50 border-b border-{{ $days <= 7 ? 'red' : 'green' }}-200">
        <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 py-4">
            <div class="flex items-center justify-center gap-3 text-{{ $days <= 7 ? 'red' : 'green' }}-800">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                </svg>
                <span class="font-semibold">
                    @if($days == 0)
                        ⚠️ Inscrições encerram hoje!
                    @elseif($days == 1)
                        ⚠️ Inscrições encerram amanhã!
                    @elseif($days <= 7)
                        ⚠️ Faltam {{ $days }} dias para encerramento das inscrições
                    @else
                        ✓ {{ $days }} dias restantes para inscrição
                    @endif
                </span>
            </div>
        </div>
    </div>
@endif

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
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"></path>
                            </svg>
                        </div>
                        <div>
                            <p class="text-xs text-gray-500 uppercase tracking-wider">Instituição</p>
                            <p class="text-sm font-medium text-gray-900">{{ $publicNotice->institution }}</p>
                        </div>
                    </div>
                    
                    @if($publicNotice->opening_date)
                        <div class="flex items-center gap-3">
                            <div class="w-10 h-10 bg-primary/10 rounded-lg flex items-center justify-center">
                                <svg class="w-5 h-5 text-primary" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                                </svg>
                            </div>
                            <div>
                                <p class="text-xs text-gray-500 uppercase tracking-wider">Data de Abertura</p>
                                <p class="text-sm font-medium text-gray-900">{{ $publicNotice->opening_date->format('d/m/Y') }}</p>
                            </div>
                        </div>
                    @endif
                    
                    @if($publicNotice->deadline)
                        <div class="flex items-center gap-3">
                            <div class="w-10 h-10 bg-{{ $publicNotice->isOpen() ? 'green' : 'red' }}-100 rounded-lg flex items-center justify-center">
                                <svg class="w-5 h-5 text-{{ $publicNotice->isOpen() ? 'green' : 'red' }}-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                </svg>
                            </div>
                            <div>
                                <p class="text-xs text-gray-500 uppercase tracking-wider">Prazo para Inscrição</p>
                                <p class="text-sm font-medium text-gray-900">{{ $publicNotice->getFormattedDeadline() }}</p>
                            </div>
                        </div>
                    @endif
                    
                    @if($publicNotice->budget)
                        <div class="flex items-center gap-3">
                            <div class="w-10 h-10 bg-green-100 rounded-lg flex items-center justify-center">
                                <svg class="w-5 h-5 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                </svg>
                            </div>
                            <div>
                                <p class="text-xs text-gray-500 uppercase tracking-wider">Valor Total</p>
                                <p class="text-sm font-medium text-gray-900">{{ $publicNotice->getFormattedBudget() }}</p>
                            </div>
                        </div>
                    @endif
                </div>
            </div>

            <!-- Resumo e Conteúdo -->
            <div class="p-6 md:p-8">
                <h2 class="text-xl font-bold text-gray-900 mb-4">Sobre o Edital</h2>
                <div class="prose prose-lg max-w-none text-gray-700 mb-6">
                    {{ $publicNotice->summary }}
                </div>

                @if($publicNotice->content)
                    <div class="prose prose-lg max-w-none text-gray-700">
                        {!! nl2br(e($publicNotice->content)) !!}
                    </div>
                @endif

                <!-- Ações -->
                <div class="mt-8 pt-6 border-t border-gray-200 flex flex-wrap gap-4">
                    @if($publicNotice->file)
                        <a 
                            href="{{ $publicNotice->getFileUrl() }}" 
                            target="_blank"
                            class="inline-flex items-center gap-2 bg-primary text-white px-6 py-3 rounded-lg font-semibold hover:bg-opacity-90 transition-all"
                        >
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 10v6m0 0l-3-3m3 3l3-3m2 8H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                            </svg>
                            Baixar Edital Completo
                        </a>
                    @endif
                    
                    @if($publicNotice->external_link)
                        <a 
                            href="{{ $publicNotice->external_link }}" 
                            target="_blank"
                            class="inline-flex items-center gap-2 bg-green-600 text-white px-6 py-3 rounded-lg font-semibold hover:bg-opacity-90 transition-all"
                        >
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14"></path>
                            </svg>
                            @if($publicNotice->isOpen())
                                Acessar Inscrição
                            @else
                                Acessar Site Oficial
                            @endif
                        </a>
                    @endif
                </div>
            </div>
        </div>

        <!-- Voltar -->
        <div class="mt-8">
            <a 
                href="{{ route('editais.index') }}" 
                class="inline-flex items-center gap-2 text-gray-600 hover:text-primary transition-colors"
            >
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"></path>
                </svg>
                Voltar para Editais
            </a>
        </div>
    </div>
</section>

<!-- Editais Relacionados -->
@if($relatedNotices->count() > 0)
<section class="py-12 bg-gray-50">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <h2 class="text-2xl font-bold text-gray-900 mb-8">Editais Relacionados</h2>
        
        <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
            @foreach($relatedNotices as $related)
                <article class="bg-white rounded-lg shadow-md hover:shadow-lg transition-shadow p-6">
                    <div class="flex items-center gap-2 mb-3">
                        <span class="inline-block px-3 py-1 bg-{{ $related->getStatusColor() }}-100 text-{{ $related->getStatusColor() }}-800 text-xs font-semibold rounded-full">
                            {{ $related->getStatusName() }}
                        </span>
                        <span class="inline-block px-3 py-1 bg-gray-100 text-gray-700 text-xs font-semibold rounded-full">
                            {{ $related->getTypeName() }}
                        </span>
                    </div>
                    <h3 class="text-lg font-bold text-gray-900 mb-2 line-clamp-2">
                        <a href="{{ route('editais.show', $related->slug) }}" class="hover:text-primary transition-colors">
                            {{ $related->title }}
                        </a>
                    </h3>
                    <p class="text-sm text-gray-600 line-clamp-1 mb-3">{{ $related->institution }}</p>
                    <a 
                        href="{{ route('editais.show', $related->slug) }}" 
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

@extends('layouts.app')

@section('meta_title', $patent->title . ' | Patentes | CI Cacau')
@section('meta_description', Str::limit($patent->summary, 160))

@section('content')
<!-- Hero Section -->
<section class="bg-gradient-to-br from-primary to-secondary text-white py-12 md:py-16">
    <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center">
            <span class="inline-block px-4 py-1 bg-white/20 rounded-full text-sm font-semibold mb-4">
                {{ $patent->getStatusName() }}
            </span>
            <h1 class="text-3xl md:text-4xl font-bold mb-4">
                {{ $patent->title }}
            </h1>
            @if($patent->patent_number)
                <p class="text-lg text-white/90 font-mono">
                    {{ $patent->patent_number }}
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
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9.663 17h4.673M12 3v1m6.364 1.636l-.707.707M21 12h-1M4 12H3m3.343-5.657l-.707-.707m2.828 9.9a5 5 0 117.072 0l-.548.547A3.374 3.374 0 0014 18.469V19a2 2 0 11-4 0v-.531c0-.895-.356-1.754-.988-2.386l-.548-.547z"></path>
                            </svg>
                        </div>
                        <div>
                            <p class="text-xs text-gray-500 uppercase tracking-wider">Inventores</p>
                            <p class="text-sm font-medium text-gray-900">{{ $patent->inventors }}</p>
                        </div>
                    </div>
                    
                    @if($patent->applicant)
                        <div class="flex items-center gap-3">
                            <div class="w-10 h-10 bg-primary/10 rounded-lg flex items-center justify-center">
                                <svg class="w-5 h-5 text-primary" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                                </svg>
                            </div>
                            <div>
                                <p class="text-xs text-gray-500 uppercase tracking-wider">Depositante/Titular</p>
                                <p class="text-sm font-medium text-gray-900">{{ $patent->applicant }}</p>
                            </div>
                        </div>
                    @endif
                    
                    @if($patent->institution)
                        <div class="flex items-center gap-3">
                            <div class="w-10 h-10 bg-primary/10 rounded-lg flex items-center justify-center">
                                <svg class="w-5 h-5 text-primary" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"></path>
                                </svg>
                            </div>
                            <div>
                                <p class="text-xs text-gray-500 uppercase tracking-wider">Instituição</p>
                                <p class="text-sm font-medium text-gray-900">{{ $patent->institution }}</p>
                            </div>
                        </div>
                    @endif
                    
                    <div class="flex items-center gap-3">
                        <div class="w-10 h-10 bg-{{ $patent->getStatusColor() }}-100 rounded-lg flex items-center justify-center">
                            <svg class="w-5 h-5 text-{{ $patent->getStatusColor() }}-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                            </svg>
                        </div>
                        <div>
                            <p class="text-xs text-gray-500 uppercase tracking-wider">Status</p>
                            <p class="text-sm font-medium text-gray-900">{{ $patent->getStatusName() }}</p>
                        </div>
                    </div>
                </div>

                <!-- Datas -->
                @if($patent->filing_date || $patent->grant_date)
                    <div class="mt-4 pt-4 border-t border-gray-200">
                        <div class="flex flex-wrap gap-6">
                            @if($patent->filing_date)
                                <div>
                                    <p class="text-xs text-gray-500 uppercase tracking-wider">Data de Depósito</p>
                                    <p class="text-sm font-medium text-gray-900">{{ $patent->getFormattedFilingDate() }}</p>
                                </div>
                            @endif
                            @if($patent->grant_date)
                                <div>
                                    <p class="text-xs text-gray-500 uppercase tracking-wider">Data de Concessão</p>
                                    <p class="text-sm font-medium text-gray-900">{{ $patent->getFormattedGrantDate() }}</p>
                                </div>
                            @endif
                        </div>
                    </div>
                @endif
            </div>

            <!-- Resumo -->
            <div class="p-6 md:p-8">
                <h2 class="text-xl font-bold text-gray-900 mb-4">Resumo</h2>
                <div class="prose prose-lg max-w-none text-gray-700">
                    {{ $patent->summary }}
                </div>

                <!-- Ações -->
                <div class="mt-8 pt-6 border-t border-gray-200 flex flex-wrap gap-4">
                    @if($patent->file)
                        <a 
                            href="{{ $patent->getFileUrl() }}" 
                            target="_blank"
                            class="inline-flex items-center gap-2 bg-primary text-white px-6 py-3 rounded-lg font-semibold hover:bg-opacity-90 transition-all"
                        >
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 10v6m0 0l-3-3m3 3l3-3m2 8H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                            </svg>
                            Baixar Documento
                        </a>
                    @endif
                    
                    @if($patent->external_link)
                        <a 
                            href="{{ $patent->external_link }}" 
                            target="_blank"
                            class="inline-flex items-center gap-2 bg-gray-100 text-gray-700 px-6 py-3 rounded-lg font-semibold hover:bg-gray-200 transition-all"
                        >
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14"></path>
                            </svg>
                            Acessar no INPI
                        </a>
                    @endif
                </div>
            </div>
        </div>

        <!-- Voltar -->
        <div class="mt-8">
            <a 
                href="{{ route('patentes.index') }}" 
                class="inline-flex items-center gap-2 text-gray-600 hover:text-primary transition-colors"
            >
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"></path>
                </svg>
                Voltar para Patentes
            </a>
        </div>
    </div>
</section>

<!-- Patentes Relacionadas -->
@if($relatedPatents->count() > 0)
<section class="py-12 bg-gray-50">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <h2 class="text-2xl font-bold text-gray-900 mb-8">Patentes Relacionadas</h2>
        
        <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
            @foreach($relatedPatents as $related)
                <article class="bg-white rounded-lg shadow-md hover:shadow-lg transition-shadow p-6">
                    <span class="inline-block px-3 py-1 bg-{{ $related->getStatusColor() }}-100 text-{{ $related->getStatusColor() }}-800 text-xs font-semibold rounded-full mb-3">
                        {{ $related->getStatusName() }}
                    </span>
                    <h3 class="text-lg font-bold text-gray-900 mb-2 line-clamp-2">
                        <a href="{{ route('patentes.show', $related->slug) }}" class="hover:text-primary transition-colors">
                            {{ $related->title }}
                        </a>
                    </h3>
                    <p class="text-sm text-gray-600 line-clamp-1 mb-3">{{ $related->inventors }}</p>
                    <a 
                        href="{{ route('patentes.show', $related->slug) }}" 
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

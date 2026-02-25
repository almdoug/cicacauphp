@extends('layouts.app')

@section('meta_title', 'Cursos e Eventos | CI Cacau')
@section('meta_description', 'Acompanhe os cursos, workshops e eventos sobre a cadeia produtiva do cacau. Capacitação profissional e oportunidades de networking no setor cacaueiro.')

@section('content')
<!-- Hero Section -->
<section class="bg-gradient-to-br from-primary to-secondary text-white py-16 md:py-20">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center">
            <h1 class="text-4xl md:text-5xl font-bold mb-4">
                Cursos e Eventos
            </h1>
            <p class="text-xl md:text-2xl text-white/90 max-w-3xl mx-auto">
                Capacitação, workshops e eventos para profissionais da cadeia produtiva do cacau
            </p>
        </div>
    </div>
</section>

<!-- Filtros -->
<section class="py-6 bg-gray-50 border-b border-gray-200">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex flex-wrap gap-3 justify-center">
            <a href="{{ route('cursos-eventos.index') }}" 
               class="px-4 py-2 rounded-full text-sm font-medium transition-colors {{ !request('tipo') ? 'bg-primary text-white' : 'bg-white text-gray-700 hover:bg-primary hover:text-white' }}">
                Todos
            </a>
            <a href="{{ route('cursos-eventos.index', ['tipo' => 'curso']) }}" 
               class="px-4 py-2 rounded-full text-sm font-medium transition-colors {{ request('tipo') == 'curso' ? 'bg-primary text-white' : 'bg-white text-gray-700 hover:bg-primary hover:text-white' }}">
                Cursos
            </a>
            <a href="{{ route('cursos-eventos.index', ['tipo' => 'evento']) }}" 
               class="px-4 py-2 rounded-full text-sm font-medium transition-colors {{ request('tipo') == 'evento' ? 'bg-primary text-white' : 'bg-white text-gray-700 hover:bg-primary hover:text-white' }}">
                Eventos
            </a>
        </div>
    </div>
</section>

<!-- Lista de Cursos e Eventos -->
<section class="py-12 md:py-16 bg-white">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        @if($items->count() > 0)
            <!-- Grid -->
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6 md:gap-8">
                @foreach($items as $item)
                    <article class="bg-white rounded-xl overflow-hidden shadow-lg hover:shadow-2xl transition-all duration-300 group flex flex-col">
                        <!-- Imagem -->
                        <a href="{{ route('cursos-eventos.show', $item->slug) }}" class="block overflow-hidden relative">
                            @if($item->image)
                                <img 
                                    src="{{ $item->getImageUrl() }}" 
                                    alt="{{ $item->title }}" 
                                    class="w-full h-48 md:h-56 object-cover group-hover:scale-105 transition-transform duration-300"
                                >
                            @else
                                <div class="w-full h-48 md:h-56 bg-gradient-to-br from-primary to-secondary flex items-center justify-center">
                                    <svg class="w-20 h-20 text-white/50" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                                    </svg>
                                </div>
                            @endif
                            
                            <!-- Badge de tipo -->
                            <span class="absolute top-3 left-3 px-3 py-1 text-xs font-semibold rounded-full {{ $item->type === 'curso' ? 'bg-blue-500 text-white' : 'bg-orange-500 text-white' }}">
                                {{ $item->getTypeLabel() }}
                            </span>

                            <!-- Badge de evento futuro -->
                            @if($item->isUpcoming())
                                <span class="absolute top-3 right-3 px-3 py-1 text-xs font-semibold rounded-full bg-green-500 text-white">
                                    Em breve
                                </span>
                            @endif
                        </a>

                        <!-- Conteúdo -->
                        <div class="p-6 flex-1 flex flex-col">
                            <!-- Meta Info -->
                            <div class="flex flex-wrap items-center gap-3 text-sm text-gray-600 mb-3">
                                @if($item->event_date)
                                    <div class="flex items-center gap-1">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                                        </svg>
                                        <span>
                                            {{ $item->getFormattedDate() }}
                                            @if($item->event_end_date && !$item->event_end_date->eq($item->event_date))
                                                &ndash; {{ $item->event_end_date->format('d/m/Y') }}
                                            @endif
                                        </span>
                                    </div>
                                @endif
                                
                                @if($item->getFormattedTime())
                                    <span class="text-gray-400">•</span>
                                    <div class="flex items-center gap-1">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                        </svg>
                                        <span>{{ $item->getFormattedTime() }}</span>
                                    </div>
                                @endif
                            </div>

                            @if($item->location)
                                <div class="flex items-center gap-1 text-sm text-gray-500 mb-3">
                                    <svg class="w-4 h-4 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path>
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                    </svg>
                                    <span class="truncate">{{ $item->location }}</span>
                                </div>
                            @endif

                            <!-- Título -->
                            <h2 class="text-xl md:text-2xl font-bold text-gray-900 mb-3 group-hover:text-primary transition-colors line-clamp-2">
                                <a href="{{ route('cursos-eventos.show', $item->slug) }}">
                                    {{ $item->title }}
                                </a>
                            </h2>

                            <!-- Resumo -->
                            <p class="text-gray-600 mb-4 line-clamp-3 flex-1">
                                {{ $item->summary }}
                            </p>

                            <!-- Botões -->
                            <div class="flex items-center justify-between pt-4 border-t border-gray-200">
                                @if($item->registration_link)
                                    <a 
                                        href="{{ $item->registration_link }}" 
                                        target="_blank"
                                        class="inline-flex items-center gap-2 bg-secondary text-white px-4 py-2 rounded-lg text-sm font-semibold hover:bg-opacity-90 transition-all"
                                    >
                                        Acessar Evento
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14"></path>
                                        </svg>
                                    </a>
                                @else
                                    <span></span>
                                @endif

                                <a 
                                    href="{{ route('cursos-eventos.show', $item->slug) }}" 
                                    class="inline-flex items-center gap-2 text-primary font-semibold hover:gap-3 transition-all text-sm"
                                >
                                    Saiba mais
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
            <div class="mt-12">
                {{ $items->links() }}
            </div>
        @else
            <!-- Estado Vazio -->
            <div class="text-center py-16">
                <div class="inline-flex items-center justify-center w-20 h-20 bg-gray-100 rounded-full mb-6">
                    <svg class="w-10 h-10 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                    </svg>
                </div>
                <h3 class="text-xl font-semibold text-gray-800 mb-2">Nenhum curso ou evento encontrado</h3>
                <p class="text-gray-600 max-w-md mx-auto">
                    Em breve teremos novos cursos e eventos. Fique atento às novidades!
                </p>
            </div>
        @endif
    </div>
</section>

<!-- CTA Section -->
<section class="py-12 md:py-16 bg-gradient-to-br from-primary/5 to-secondary/5">
    <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
        <h2 class="text-2xl md:text-3xl font-bold text-gray-900 mb-4">
            Quer promover um curso ou evento?
        </h2>
        <p class="text-gray-600 mb-8 max-w-2xl mx-auto">
            Entre em contato conosco para divulgar seu curso ou evento relacionado à cadeia produtiva do cacau.
        </p>
        <a 
            href="{{ route('contato') }}" 
            class="inline-flex items-center gap-2 bg-primary text-white px-8 py-3 rounded-lg font-semibold hover:bg-opacity-90 transition-all"
        >
            Entre em Contato
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path>
            </svg>
        </a>
    </div>
</section>
@endsection

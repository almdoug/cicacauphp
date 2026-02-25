@extends('layouts.app')

@section('meta_title', $item->title . ' | Cursos e Eventos | CI Cacau')
@section('meta_description', $item->summary)

@section('content')
<!-- Hero Section -->
<section class="bg-gradient-to-br from-primary to-secondary text-white py-12 md:py-16">
    <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">
        <!-- Breadcrumb -->
        <nav class="mb-6">
            <ol class="flex items-center gap-2 text-sm text-white/80">
                <li>
                    <a href="{{ route('home') }}" class="hover:text-white transition-colors">Início</a>
                </li>
                <li>
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                    </svg>
                </li>
                <li>
                    <a href="{{ route('cursos-eventos.index') }}" class="hover:text-white transition-colors">Cursos e Eventos</a>
                </li>
                <li>
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                    </svg>
                </li>
                <li class="truncate">{{ $item->title }}</li>
            </ol>
        </nav>

        <!-- Badge de tipo -->
        <span class="inline-block px-4 py-1 text-sm font-semibold rounded-full mb-4 {{ $item->type === 'curso' ? 'bg-blue-500 text-white' : 'bg-orange-500 text-white' }}">
            {{ $item->getTypeLabel() }}
        </span>

        <h1 class="text-3xl md:text-4xl lg:text-5xl font-bold mb-4">
            {{ $item->title }}
        </h1>

        <div class="flex flex-wrap items-center gap-4 text-white/90">
            @if($item->event_date)
                <div class="flex items-center gap-2">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
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
                <div class="flex items-center gap-2">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                    </svg>
                    <span>{{ $item->getFormattedTime() }}</span>
                </div>
            @endif

            @if($item->location)
                <div class="flex items-center gap-2">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path>
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path>
                    </svg>
                    <span>{{ $item->location }}</span>
                </div>
            @endif
        </div>
    </div>
</section>

<!-- Conteúdo -->
<section class="py-12 md:py-16 bg-white">
    <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
            <!-- Conteúdo Principal -->
            <div class="lg:col-span-2">
                <!-- Imagem -->
                @if($item->image)
                    <div class="mb-8 rounded-xl overflow-hidden shadow-lg">
                        <img 
                            src="{{ $item->getImageUrl() }}" 
                            alt="{{ $item->title }}" 
                            class="w-full h-auto object-cover"
                        >
                    </div>
                @endif

                <!-- Resumo -->
                <div class="bg-gray-50 rounded-lg p-6 mb-8">
                    <p class="text-lg text-gray-700 leading-relaxed">
                        {{ $item->summary }}
                    </p>
                </div>

                <!-- Autor -->
                <div class="mt-8 pt-8 border-t border-gray-200">
                    <div class="flex items-center gap-4">
                        <div class="w-12 h-12 bg-primary rounded-full flex items-center justify-center text-white font-bold text-lg">
                            {{ substr($item->user->name, 0, 1) }}
                        </div>
                        <div>
                            <p class="text-sm text-gray-500">Publicado por</p>
                            <p class="font-semibold text-gray-900">{{ $item->user->name }}</p>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Sidebar -->
            <div class="lg:col-span-1">
                <!-- Card de Inscrição -->
                @if($item->registration_link)
                    <div class="bg-gradient-to-br from-primary to-secondary rounded-xl p-6 text-white mb-6 sticky top-24">
                        <h3 class="text-xl font-bold mb-4">Link do Evento</h3>
                        <p class="text-white/90 mb-6">
                            Acesse as informações completas deste {{ strtolower($item->getTypeLabel()) }}.
                        </p>
                        <a 
                            href="{{ $item->registration_link }}" 
                            target="_blank"
                            class="block w-full bg-white text-primary text-center px-6 py-3 rounded-lg font-semibold hover:bg-gray-100 transition-all"
                        >
                            Acessar Evento
                        </a>
                    </div>
                @endif

                <!-- Informações -->
                <div class="bg-gray-50 rounded-xl p-6">
                    <h3 class="text-lg font-bold text-gray-900 mb-4">Informações</h3>
                    
                    <div class="space-y-4">
                        <div class="flex items-start gap-3">
                            <div class="flex-shrink-0 w-10 h-10 bg-primary/10 rounded-lg flex items-center justify-center">
                                <svg class="w-5 h-5 text-primary" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A1.994 1.994 0 013 12V7a4 4 0 014-4z"></path>
                                </svg>
                            </div>
                            <div>
                                <p class="text-sm text-gray-500">Tipo</p>
                                <p class="font-semibold text-gray-900">{{ $item->getTypeLabel() }}</p>
                            </div>
                        </div>

                        @if($item->event_date)
                            <div class="flex items-start gap-3">
                                <div class="flex-shrink-0 w-10 h-10 bg-primary/10 rounded-lg flex items-center justify-center">
                                    <svg class="w-5 h-5 text-primary" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                                    </svg>
                                </div>
                                <div>
                                    <p class="text-sm text-gray-500">Data Inicial</p>
                                    <p class="font-semibold text-gray-900">{{ $item->event_date->format('d \d\e F \d\e Y') }}</p>
                                </div>
                            </div>
                        @endif

                        @if($item->event_end_date && !$item->event_end_date->eq($item->event_date))
                            <div class="flex items-start gap-3">
                                <div class="flex-shrink-0 w-10 h-10 bg-primary/10 rounded-lg flex items-center justify-center">
                                    <svg class="w-5 h-5 text-primary" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                                    </svg>
                                </div>
                                <div>
                                    <p class="text-sm text-gray-500">Data Final</p>
                                    <p class="font-semibold text-gray-900">{{ $item->event_end_date->format('d \d\e F \d\e Y') }}</p>
                                </div>
                            </div>
                        @endif

                        @if($item->getFormattedTime())
                            <div class="flex items-start gap-3">
                                <div class="flex-shrink-0 w-10 h-10 bg-primary/10 rounded-lg flex items-center justify-center">
                                    <svg class="w-5 h-5 text-primary" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                    </svg>
                                </div>
                                <div>
                                    <p class="text-sm text-gray-500">Horário</p>
                                    <p class="font-semibold text-gray-900">{{ $item->getFormattedTime() }}</p>
                                </div>
                            </div>
                        @endif

                        @if($item->location)
                            <div class="flex items-start gap-3">
                                <div class="flex-shrink-0 w-10 h-10 bg-primary/10 rounded-lg flex items-center justify-center">
                                    <svg class="w-5 h-5 text-primary" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path>
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                    </svg>
                                </div>
                                <div>
                                    <p class="text-sm text-gray-500">Local</p>
                                    <p class="font-semibold text-gray-900">{{ $item->location }}</p>
                                </div>
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Relacionados -->
@if($relatedItems->count() > 0)
<section class="py-12 md:py-16 bg-gray-50">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <h2 class="text-2xl md:text-3xl font-bold text-gray-900 mb-8">
            Outros Cursos e Eventos
        </h2>

        <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
            @foreach($relatedItems as $related)
                <article class="bg-white rounded-xl overflow-hidden shadow-lg hover:shadow-xl transition-shadow group">
                    <a href="{{ route('cursos-eventos.show', $related->slug) }}" class="block overflow-hidden relative">
                        @if($related->image)
                            <img 
                                src="{{ $related->getImageUrl() }}" 
                                alt="{{ $related->title }}" 
                                class="w-full h-40 object-cover group-hover:scale-105 transition-transform duration-300"
                            >
                        @else
                            <div class="w-full h-40 bg-gradient-to-br from-primary to-secondary flex items-center justify-center">
                                <svg class="w-12 h-12 text-white/50" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                                </svg>
                            </div>
                        @endif
                        <span class="absolute top-3 left-3 px-3 py-1 text-xs font-semibold rounded-full {{ $related->type === 'curso' ? 'bg-blue-500 text-white' : 'bg-orange-500 text-white' }}">
                            {{ $related->getTypeLabel() }}
                        </span>
                    </a>
                    <div class="p-5">
                        <h3 class="font-bold text-gray-900 mb-2 line-clamp-2 group-hover:text-primary transition-colors">
                            <a href="{{ route('cursos-eventos.show', $related->slug) }}">
                                {{ $related->title }}
                            </a>
                        </h3>
                        @if($related->event_date)
                            <p class="text-sm text-gray-500">{{ $related->getFormattedDate() }}</p>
                        @endif
                    </div>
                </article>
            @endforeach
        </div>
    </div>
</section>
@endif
@endsection

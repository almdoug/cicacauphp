@extends('layouts.app')

@section('meta_title', 'Entrevistas | CI Cacau')
@section('meta_description', 'Confira entrevistas exclusivas com especialistas, pesquisadores e profissionais da cadeia produtiva do cacau. Insights e conhecimento direto de quem faz o setor.')

@section('content')
<!-- Hero Section -->
<section class="bg-gradient-to-br from-primary to-secondary text-white py-16 md:py-20">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center">
            <h1 class="text-4xl md:text-5xl font-bold mb-4">
                Entrevistas
            </h1>
            <p class="text-xl md:text-2xl text-white/90 max-w-3xl mx-auto">
                Conversas exclusivas com especialistas e profissionais da cadeia produtiva do cacau
            </p>
        </div>
    </div>
</section>

<!-- Lista de Entrevistas -->
<section class="py-12 md:py-16 bg-white">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        @if($interviews->count() > 0)
            <!-- Grid -->
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6 md:gap-8">
                @foreach($interviews as $interview)
                    <article class="bg-white rounded-xl overflow-hidden shadow-lg hover:shadow-2xl transition-all duration-300 group flex flex-col">
                        <!-- Imagem -->
                        <a href="{{ route('entrevistas.show', $interview->slug) }}" class="block overflow-hidden relative">
                            @if($interview->image)
                                <img 
                                    src="{{ $interview->getImageUrl() }}" 
                                    alt="{{ $interview->title }}" 
                                    class="w-full h-48 md:h-56 object-cover group-hover:scale-105 transition-transform duration-300"
                                >
                            @else
                                <div class="w-full h-48 md:h-56 bg-gradient-to-br from-primary to-secondary flex items-center justify-center">
                                    <svg class="w-20 h-20 text-white/50" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11a7 7 0 01-7 7m0 0a7 7 0 01-7-7m7 7v4m0 0H8m4 0h4m-4-8a3 3 0 01-3-3V5a3 3 0 116 0v6a3 3 0 01-3 3z"></path>
                                    </svg>
                                </div>
                            @endif
                            
                            <!-- Badge de vídeo -->
                            @if($interview->video_url)
                                <span class="absolute top-3 right-3 p-2 bg-red-600 text-white rounded-full">
                                    <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24">
                                        <path d="M8 5v14l11-7z"/>
                                    </svg>
                                </span>
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
                                    <span>{{ $interview->getFormattedDate() }}</span>
                                </div>
                            </div>

                            <!-- Entrevistado -->
                            <div class="flex items-center gap-3 mb-4">
                                <div class="w-10 h-10 bg-secondary rounded-full flex items-center justify-center text-white font-bold">
                                    {{ substr($interview->interviewee_name, 0, 1) }}
                                </div>
                                <div>
                                    <p class="font-semibold text-gray-900 text-sm">{{ $interview->interviewee_name }}</p>
                                    @if($interview->interviewee_role)
                                        <p class="text-xs text-gray-500">{{ $interview->interviewee_role }}</p>
                                    @endif
                                </div>
                            </div>

                            <!-- Título -->
                            <h2 class="text-xl md:text-2xl font-bold text-gray-900 mb-3 group-hover:text-primary transition-colors line-clamp-2">
                                <a href="{{ route('entrevistas.show', $interview->slug) }}">
                                    {{ $interview->title }}
                                </a>
                            </h2>

                            <!-- Resumo -->
                            <p class="text-gray-600 mb-4 line-clamp-3 flex-1">
                                {{ $interview->summary }}
                            </p>

                            <!-- Link -->
                            <div class="pt-4 border-t border-gray-200">
                                <a 
                                    href="{{ route('entrevistas.show', $interview->slug) }}" 
                                    class="inline-flex items-center gap-2 text-primary font-semibold hover:gap-3 transition-all text-sm"
                                >
                                    @if($interview->video_url)
                                        Assistir entrevista
                                    @else
                                        Ler entrevista
                                    @endif
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
                {{ $interviews->links() }}
            </div>
        @else
            <!-- Estado Vazio -->
            <div class="text-center py-16">
                <div class="inline-flex items-center justify-center w-20 h-20 bg-gray-100 rounded-full mb-6">
                    <svg class="w-10 h-10 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11a7 7 0 01-7 7m0 0a7 7 0 01-7-7m7 7v4m0 0H8m4 0h4m-4-8a3 3 0 01-3-3V5a3 3 0 116 0v6a3 3 0 01-3 3z"></path>
                    </svg>
                </div>
                <h3 class="text-xl font-semibold text-gray-800 mb-2">Nenhuma entrevista encontrada</h3>
                <p class="text-gray-600 max-w-md mx-auto">
                    Em breve teremos novas entrevistas. Fique atento às novidades!
                </p>
            </div>
        @endif
    </div>
</section>

<!-- CTA Section -->
<section class="py-12 md:py-16 bg-gradient-to-br from-primary/5 to-secondary/5">
    <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
        <h2 class="text-2xl md:text-3xl font-bold text-gray-900 mb-4">
            Quer participar de uma entrevista?
        </h2>
        <p class="text-gray-600 mb-8 max-w-2xl mx-auto">
            Se você é especialista, pesquisador ou profissional do setor cacaueiro e gostaria de compartilhar seu conhecimento, entre em contato.
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

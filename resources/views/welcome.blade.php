@extends('layouts.app')

@section('meta_title', 'CI Cacau | Centro de Inteligência da Cadeia Produtiva do Cacau')
@section('meta_description', 'Conheça o CI Cacau — o portal de inteligência e inovação sobre a cadeia produtiva do cacau no Brasil. Dados, pesquisas, mercado, cursos e notícias atualizadas.')

@section('content')
<!-- Hero Section -->
<section class="bg-gradient-to-br from-gray-50 to-white py-12 md:py-20">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-8 lg:gap-12 items-center">
            <!-- Left Side - Text Content -->
            <div class="space-y-6 text-center md:text-left">
                <div class="space-y-2">
                    <h1 class="text-3xl sm:text-4xl lg:text-5xl xl:text-6xl font-bold text-gray-900 leading-tight">
                        {{ content($contents, 'hero', 'title', 'Centro de Inteligência do Cacau (CI Cacau)') }}
                    </h1>
                </div>

                <h2 class="text-xl md:text-2xl lg:text-3xl font-semibold text-gray-800 leading-tight">
                    {{ content($contents, 'hero', 'subtitle', 'Conhecimento e inteligência para o desenvolvimento do cacau no Brasil') }}
                </h2>

                <p class="text-base md:text-lg text-gray-700 leading-relaxed">
                    {{ content($contents, 'hero', 'description', 'O Centro de Inteligência do Cacau (CI Cacau) é uma plataforma dedicada à coleta, análise e difusão de informações estratégicas sobre o setor cacaueiro. Nosso objetivo é conectar ciência, tecnologia e mercado para impulsionar a competitividade e sustentabilidade da cadeia produtiva do cacau.') }}
                </p>
            </div>

            <!-- Right Side - Image -->
            <div class="hidden lg:block">
                <div class="relative">
                    <div class="absolute inset-0 bg-primary opacity-10 rounded-3xl transform rotate-3"></div>
                    <img
                        src="{{ asset('images/hero.png') }}"
                        alt="CI Cacau - Centro de Inteligência do Cacau"
                        class="relative">
                </div>
            </div>
        </div>

        <!-- Sponsor Logo Section -->
        <div class="mt-12 md:mt-16">
            <div class="flex flex-col items-center gap-4">
                <div class="hover:shadow-lg transition-shadow">
                    <img
                        src="{{ asset('images/uesc.svg') }}"
                        alt="UESC - Universidade Estadual de Santa Cruz"
                        class="h-16 md:h-20 w-auto">
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Mercado Section -->
<section class="py-16 md:py-24 bg-white">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center mb-12">
            <h2 class="text-3xl md:text-4xl font-bold text-gray-900 mb-4">
                {{ content($contents, 'mercado', 'title', 'Acompanhe o mercado') }}
            </h2>
            <h3 class="text-xl md:text-2xl font-semibold text-primary mb-6">
                {{ content($contents, 'mercado', 'subtitle', 'Indicadores e estatísticas atualizadas') }}
            </h3>
        </div>

        <div class="mb-10">
            {!! content($contents, 'mercado', 'cards', '<div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                <div class="bg-gray-50 p-6 rounded-xl hover:shadow-lg transition-shadow">
                    <div class="flex items-center justify-center w-16 h-16 bg-primary bg-opacity-10 rounded-lg mb-4"><svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                        </svg></div>
                    <p class="text-gray-700 font-medium">Preços, produção e exportações</p>
                </div>
                <div class="bg-gray-50 p-6 rounded-xl hover:shadow-lg transition-shadow">
                    <div class="flex items-center justify-center w-16 h-16 bg-primary bg-opacity-10 rounded-lg mb-4"><svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3.055 11H5a2 2 0 012 2v1a2 2 0 002 2 2 2 0 012 2v2.945M8 3.935V5.5A2.5 2.5 0 0010.5 8h.5a2 2 0 012 2 2 2 0 104 0 2 2 0 012-2h1.064M15 20.488V18a2 2 0 012-2h3.064M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                        </svg></div>
                    <p class="text-gray-700 font-medium">Mercado nacional e internacional</p>
                </div>
            </div>') !!}
        </div>

        <div class="text-center">
            <a href="{{ content($contents, 'mercado', 'button_link', '#') }}" class="inline-flex items-center gap-2 bg-primary text-white px-8 py-4 rounded-lg font-semibold hover:bg-opacity-90 transition-all shadow-lg hover:shadow-xl text-lg">
                {{ content($contents, 'mercado', 'button_text', 'Acesse o Mercado') }}
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7l5 5m0 0l-5 5m5-5H6"></path>
                </svg>
            </a>
        </div>
    </div>
</section>

<!-- Ciência e Tecnologia Section -->
<section class="py-16 md:py-24 bg-gradient-to-br from-gray-50 to-white">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center mb-12">
            <h2 class="text-3xl md:text-4xl font-bold text-gray-900 mb-4">
                {{ content($contents, 'ciencia', 'title', 'Ciência e Tecnologia') }}
            </h2>
            <h3 class="text-xl md:text-2xl font-semibold text-primary mb-6">
                {{ content($contents, 'ciencia', 'subtitle', 'Produções técnico-científicas e inovação') }}
            </h3>
            <p class="text-lg text-gray-700 max-w-3xl mx-auto">
                {{ content($contents, 'ciencia', 'description', 'Acesse artigos, livros, relatórios e projetos desenvolvidos por universidades, centros de pesquisa e profissionais do setor.') }}
            </p>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-10">
            <div class="bg-white p-6 rounded-xl border border-gray-200 hover:border-primary hover:shadow-lg transition-all">
                <div class="flex items-center justify-center w-14 h-14 bg-secondary bg-opacity-20 rounded-lg mb-4 mx-auto">
                    <svg class="w-7 h-7 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                    </svg>
                </div>
                <p class="text-center text-gray-700 font-medium">Artigos e Documentos</p>
            </div>

            <div class="bg-white p-6 rounded-xl border border-gray-200 hover:border-primary hover:shadow-lg transition-all">
                <div class="flex items-center justify-center w-14 h-14 bg-secondary bg-opacity-20 rounded-lg mb-4 mx-auto">
                    <svg class="w-7 h-7 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"></path>
                    </svg>
                </div>
                <p class="text-center text-gray-700 font-medium">Livros</p>
            </div>

            <div class="bg-white p-6 rounded-xl border border-gray-200 hover:border-primary hover:shadow-lg transition-all">
                <div class="flex items-center justify-center w-14 h-14 bg-secondary bg-opacity-20 rounded-lg mb-4 mx-auto">
                    <svg class="w-7 h-7 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"></path>
                    </svg>
                </div>
                <p class="text-center text-gray-700 font-medium">Patentes</p>
            </div>

            <div class="bg-white p-6 rounded-xl border border-gray-200 hover:border-primary hover:shadow-lg transition-all">
                <div class="flex items-center justify-center w-14 h-14 bg-secondary bg-opacity-20 rounded-lg mb-4 mx-auto">
                    <svg class="w-7 h-7 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 20H5a2 2 0 01-2-2V6a2 2 0 012-2h10a2 2 0 012 2v1m2 13a2 2 0 01-2-2V7m2 13a2 2 0 002-2V9a2 2 0 00-2-2h-2m-4-3H9M7 16h6M7 8h6v4H7V8z"></path>
                    </svg>
                </div>
                <p class="text-center text-gray-700 font-medium">Teses e Dissertações</p>
            </div>
        </div>

        <div class="text-center">
            <a href="{{ content($contents, 'ciencia', 'button_link', '#') }}" class="inline-flex items-center gap-2 bg-secondary text-gray-900 px-8 py-4 rounded-lg font-semibold hover:bg-opacity-90 transition-all shadow-lg hover:shadow-xl text-lg">
                {{ content($contents, 'ciencia', 'button_text', 'Explore a produção científica') }}
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7l5 5m0 0l-5 5m5-5H6"></path>
                </svg>
            </a>
        </div>
    </div>
</section>

<!-- Notícias e Destaques Section -->
<section class="py-16 md:py-24 bg-white">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center mb-12">
            <h2 class="text-3xl md:text-4xl font-bold text-gray-900 mb-4">
                {{ content($contents, 'noticias', 'title', 'Notícias e Destaques') }}
            </h2>
            <h3 class="text-xl md:text-2xl font-semibold text-primary mb-6">
                {{ content($contents, 'noticias', 'subtitle', 'O que está acontecendo no mundo do cacau') }}
            </h3>
            <p class="text-lg text-gray-700 max-w-3xl mx-auto">
                {{ content($contents, 'noticias', 'description', 'Fique por dentro de eventos, cursos, editais e as principais notícias sobre o setor.') }}
            </p>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8 mb-10">
            @forelse($news as $item)
            <!-- Card de Notícia -->
            <div class="bg-gray-50 rounded-xl overflow-hidden hover:shadow-xl transition-all group">
                @if($item->image)
                <div class="h-48 overflow-hidden">
                    <img
                        src="{{ asset('storage/' . $item->image) }}"
                        alt="{{ $item->title }}"
                        class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-300">
                </div>
                @else
                <div class="h-48 bg-gradient-to-br from-primary to-secondary"></div>
                @endif
                <div class="p-6">
                    @if($item->source)
                    <span class="text-sm text-primary font-semibold">{{ $item->source }}</span>
                    @endif
                    <h4 class="text-xl font-bold text-gray-900 mt-2 mb-3 group-hover:text-primary transition-colors">
                        {{ Str::limit($item->title, 60) }}
                    </h4>
                    <p class="text-gray-700 mb-4 line-clamp-3">
                        {{ $item->summary }}
                    </p>
                    <a href="{{ route('noticias.show', $item->slug) }}" class="inline-flex items-center gap-2 text-primary font-semibold hover:gap-3 transition-all">
                        Ler mais
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                        </svg>
                    </a>
                </div>
            </div>
            @empty
            <div class="col-span-3 text-center py-12">
                <p class="text-gray-600 text-lg">Nenhuma notícia publicada ainda.</p>
            </div>
            @endforelse
        </div>

        <div class="text-center">
            <a href="{{ route('noticias.index') }}" class="inline-flex items-center gap-2 bg-gray-900 text-white px-8 py-4 rounded-lg font-semibold hover:bg-gray-800 transition-all shadow-lg hover:shadow-xl text-lg">
                Veja mais
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7l5 5m0 0l-5 5m5-5H6"></path>
                </svg>
            </a>
        </div>
    </div>
</section>

<!-- Conecte-se Section -->
<section class="py-16 md:py-24 bg-gradient-to-br from-primary to-secondary">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center text-white">
            <h2 class="text-3xl md:text-4xl font-bold mb-4">
                {{ content($contents, 'conecte', 'title', 'Conecte-se com o CI Cacau') }}
            </h2>
            <h3 class="text-xl md:text-2xl font-semibold mb-6">
                {{ content($contents, 'conecte', 'subtitle', 'Parceiros, instituições e profissionais unidos pelo desenvolvimento sustentável do cacau.') }}
            </h3>
            <p class="text-lg mb-10 max-w-3xl mx-auto opacity-95">
                {{ content($contents, 'conecte', 'description', 'Faça parte desta rede de conhecimento e colaboração. Entre em contato conosco e descubra como podemos trabalhar juntos.') }}
            </p>

            <a href="{{ content($contents, 'conecte', 'button_link', '#') }}" class="inline-flex items-center gap-2 bg-white text-primary px-8 py-4 rounded-lg font-semibold hover:bg-gray-100 transition-all shadow-lg hover:shadow-xl text-lg">
                {{ content($contents, 'conecte', 'button_text', 'Fale Conosco') }}
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7l5 5m0 0l-5 5m5-5H6"></path>
                </svg>
            </a>
        </div>
    </div>
</section>
@endsection
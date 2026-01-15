@extends('layouts.app')

@section('title', 'Sobre o CI Cacau | Centro de Inteligência do Cacau')
@section('description', 'Conheça a história, missão e equipe do Centro de Inteligência do Cacau, iniciativa da UESC dedicada à pesquisa, inovação e desenvolvimento sustentável do setor cacaueiro.')

@section('content')
<!-- Hero Section -->
<section class="bg-gradient-to-br from-primary to-secondary text-white py-20">
    <div class="container mx-auto px-4">
        <div class="max-w-4xl mx-auto text-center">
            <h1 class="text-4xl md:text-5xl font-bold mb-6">
                {{ content($contents ?? [], 'hero', 'title', 'Centro de Inteligência do Cacau') }}
            </h1>
            <p class="text-xl md:text-2xl text-white/90">
                {{ content($contents ?? [], 'hero', 'subtitle', 'Informação, pesquisa e inovação para o desenvolvimento sustentável do cacau brasileiro') }}
            </p>
        </div>
    </div>
</section>

<!-- Quem Somos -->
<section class="py-16 bg-white">
    <div class="container mx-auto px-4">
        <div class="max-w-5xl mx-auto">
            <h2 class="text-3xl md:text-4xl font-bold text-gray-800 mb-6">
                {{ content($contents ?? [], 'quem_somos', 'title', 'Quem Somos') }}
            </h2>
            
            <div class="prose prose-lg max-w-none text-gray-600 space-y-4">
                <p>
                    {{ content($contents ?? [], 'quem_somos', 'paragraph_1', 'O Centro de Inteligência do Cacau (CICacau), criado em 2013, é uma iniciativa estruturante do Sistema Agroindustrial do Cacau, vinculada ao Departamento de Ciências Econômicas e ao Programa de Pós Graduação em Economia Regional e Políticas Públicas da Universidade Estadual de Santa Cruz (UESC).') }}
                </p>
                
                <p>
                    {{ content($contents ?? [], 'quem_somos', 'paragraph_2', 'O portal foi criado para subsidiar iniciativas públicas e privadas, fomentar pesquisas científicas e tecnológicas, e promover o desenvolvimento sustentável da cadeia produtiva do cacau no Brasil.') }}
                </p>
                
                <div class="mt-6">
                    <p class="font-semibold text-gray-800 mb-3">Nosso conteúdo abrange:</p>
                    <ul class="list-disc list-inside space-y-2 text-gray-600">
                        <li>{{ content($contents ?? [], 'quem_somos', 'item_1', 'Notícias e análises de mercado') }}</li>
                        <li>{{ content($contents ?? [], 'quem_somos', 'item_2', 'Cotações e estatísticas de preços') }}</li>
                        <li>{{ content($contents ?? [], 'quem_somos', 'item_3', 'Indicadores socioeconômicos') }}</li>
                        <li>{{ content($contents ?? [], 'quem_somos', 'item_4', 'Políticas públicas e legislação') }}</li>
                        <li>{{ content($contents ?? [], 'quem_somos', 'item_5', 'Produção técnico-científica e inovação') }}</li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Propósito -->
<section class="py-16 bg-gray-50">
    <div class="container mx-auto px-4">
        <div class="max-w-5xl mx-auto">
            <h2 class="text-3xl md:text-4xl font-bold text-gray-800 mb-6">
                {{ content($contents ?? [], 'proposito', 'title', 'Propósito') }}
            </h2>
            
            <div class="prose prose-lg max-w-none text-gray-600 space-y-4">
                <p>
                    {{ content($contents ?? [], 'proposito', 'paragraph_1', 'Captar, organizar e disseminar informações mercadológicas, econômicas, técnicas, ambientais e sociais de interesse dos agentes da cadeia produtiva do cacau.') }}
                </p>
                
                <p>
                    {{ content($contents ?? [], 'proposito', 'paragraph_2', 'Nosso propósito é apoiar decisões estratégicas e políticas públicas que fortaleçam o setor e gerem valor de forma sustentável.') }}
                </p>
            </div>
        </div>
    </div>
</section>

<!-- Missão -->
<section class="py-16 bg-white">
    <div class="container mx-auto px-4">
        <div class="max-w-5xl mx-auto">
            <h2 class="text-3xl md:text-4xl font-bold text-gray-800 mb-6">
                {{ content($contents ?? [], 'missao', 'title', 'Missão') }}
            </h2>
            
            <div class="prose prose-lg max-w-none text-gray-600">
                <p>
                    {{ content($contents ?? [], 'missao', 'paragraph_1', 'Promover e divulgar conhecimento e inteligência de mercado sobre o cacau brasileiro, integrando pesquisa, inovação e negócios para fortalecer o desenvolvimento sustentável e competitivo do setor.') }}
                </p>
            </div>
        </div>
    </div>
</section>

<!-- Equipe -->
<section class="py-16 bg-gradient-to-br from-primary/5 to-secondary/5">
    <div class="container mx-auto px-4">
        <div class="max-w-5xl mx-auto">
            <h2 class="text-3xl md:text-4xl font-bold text-gray-800 mb-10">
                {{ content($contents ?? [], 'equipe', 'title', 'Equipe') }}
            </h2>
            
            <div class="space-y-4">
                @php
                    $teamMembersJson = content($contents ?? [], 'equipe', 'conteudo', '[]');
                    $teamMembers = is_string($teamMembersJson) ? json_decode($teamMembersJson, true) : $teamMembersJson;
                    $teamMembers = is_array($teamMembers) ? $teamMembers : [];
                @endphp
                
                @if(!empty($teamMembers))
                    @foreach($teamMembers as $member)
                        @if(!empty($member['name']) || !empty($member['role']))
                            <div class="bg-white rounded-lg shadow-md p-6 hover:shadow-lg transition-shadow">
                                @if(!empty($member['name']))
                                    <p class="text-lg font-semibold text-gray-800">{{ $member['name'] }}</p>
                                @endif
                                @if(!empty($member['role']))
                                    <p class="text-gray-600 mt-1">{{ $member['role'] }}</p>
                                @endif
                            </div>
                        @endif
                    @endforeach
                @else
                    <div class="bg-white rounded-lg shadow-md p-6">
                        <p class="text-gray-600">Nenhum membro cadastrado.</p>
                    </div>
                @endif
            </div>
        </div>
    </div>
</section>

<!-- CTA Section -->
<section class="bg-gradient-to-br from-primary to-secondary text-white py-16">
    <div class="container mx-auto px-4">
        <div class="max-w-4xl mx-auto text-center">
            <h2 class="text-3xl md:text-4xl font-bold mb-6">
                {{ content($contents ?? [], 'cta', 'title', 'Quer saber mais sobre o CI Cacau?') }}
            </h2>
            <p class="text-xl mb-8 text-white/90">
                {{ content($contents ?? [], 'cta', 'subtitle', 'Entre em contato conosco ou explore nosso conteúdo') }}
            </p>
            <div class="flex flex-col sm:flex-row gap-4 justify-center">
                <a href="#" class="bg-white text-primary px-8 py-3 rounded-lg font-semibold hover:bg-gray-100 transition-colors">
                    Contato
                </a>
                <a href="{{ route('home') }}" class="bg-transparent border-2 border-white text-white px-8 py-3 rounded-lg font-semibold hover:bg-white/10 transition-colors">
                    Voltar ao Início
                </a>
            </div>
        </div>
    </div>
</section>
@endsection

@extends('layouts.app')

@section('meta_title', 'Editais | CI Cacau')
@section('meta_description', 'Acompanhe os editais de pesquisa, extensão, bolsas e financiamentos relacionados à cadeia produtiva do cacau.')

@section('content')
<!-- Hero Section -->
<section class="bg-gradient-to-br from-primary to-secondary text-white py-16 md:py-20">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center">
            <h1 class="text-4xl md:text-5xl font-bold mb-4">
                Editais
            </h1>
            <p class="text-xl md:text-2xl text-white/90 max-w-3xl mx-auto">
                Oportunidades de pesquisa, bolsas e financiamentos para o setor cacaueiro
            </p>
        </div>
    </div>
</section>

<!-- Filtros -->
<section class="py-6 bg-gray-50 border-b">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <form action="{{ route('editais.index') }}" method="GET" class="flex flex-col md:flex-row gap-4 flex-wrap">
            <!-- Busca -->
            <div class="flex-1 min-w-[200px]">
                <input 
                    type="text" 
                    name="busca" 
                    value="{{ request('busca') }}"
                    placeholder="Buscar por título, instituição..."
                    class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary focus:border-primary"
                >
            </div>
            
            <!-- Tipo -->
            <div class="w-full md:w-40">
                <select 
                    name="tipo" 
                    class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary focus:border-primary"
                >
                    <option value="">Todos os tipos</option>
                    @foreach($types as $key => $label)
                        <option value="{{ $key }}" {{ request('tipo') == $key ? 'selected' : '' }}>
                            {{ $label }}
                        </option>
                    @endforeach
                </select>
            </div>
            
            <!-- Status -->
            <div class="w-full md:w-40">
                <select 
                    name="status" 
                    class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary focus:border-primary"
                >
                    <option value="">Todos os status</option>
                    @foreach($statuses as $key => $label)
                        <option value="{{ $key }}" {{ request('status') == $key ? 'selected' : '' }}>
                            {{ $label }}
                        </option>
                    @endforeach
                </select>
            </div>

            <!-- Só abertos -->
            <div class="flex items-center gap-2">
                <input 
                    type="checkbox" 
                    name="abertos" 
                    id="abertos" 
                    value="1"
                    {{ request('abertos') == '1' ? 'checked' : '' }}
                    class="w-4 h-4 text-primary border-gray-300 rounded focus:ring-primary"
                >
                <label for="abertos" class="text-sm text-gray-700">Apenas abertos</label>
            </div>
            
            <!-- Botão -->
            <button 
                type="submit" 
                class="px-6 py-2 bg-primary text-white rounded-lg hover:bg-opacity-90 transition-all font-medium"
            >
                Filtrar
            </button>
            
            @if(request()->hasAny(['busca', 'tipo', 'status', 'abertos']))
                <a 
                    href="{{ route('editais.index') }}" 
                    class="px-6 py-2 bg-gray-200 text-gray-700 rounded-lg hover:bg-gray-300 transition-all font-medium text-center"
                >
                    Limpar
                </a>
            @endif
        </form>
    </div>
</section>

<!-- Lista de Editais -->
<section class="py-12 md:py-16 bg-white">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        @if($publicNotices->count() > 0)
            <!-- Grid de Editais -->
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6 md:gap-8">
                @foreach($publicNotices as $notice)
                    <article class="bg-white rounded-xl overflow-hidden shadow-lg hover:shadow-2xl transition-all duration-300 group flex flex-col border border-gray-100">
                        <!-- Header com status e tipo -->
                        <div class="p-4 bg-gradient-to-r from-primary/10 to-secondary/10 border-b border-gray-100">
                            <div class="flex items-center justify-between flex-wrap gap-2">
                                <span class="px-3 py-1 bg-{{ $notice->getStatusColor() }}-100 text-{{ $notice->getStatusColor() }}-800 text-xs font-semibold rounded-full">
                                    {{ $notice->getStatusName() }}
                                </span>
                                <span class="px-3 py-1 bg-gray-100 text-gray-700 text-xs font-semibold rounded-full">
                                    {{ $notice->getTypeName() }}
                                </span>
                            </div>
                        </div>

                        <!-- Conteúdo -->
                        <div class="p-6 flex-1 flex flex-col">
                            <!-- Título -->
                            <h2 class="text-lg md:text-xl font-bold text-gray-900 mb-3 group-hover:text-primary transition-colors line-clamp-2">
                                <a href="{{ route('editais.show', $notice->slug) }}">
                                    {{ $notice->title }}
                                </a>
                            </h2>

                            <!-- Instituição -->
                            <div class="flex items-start gap-2 text-sm text-gray-600 mb-3">
                                <svg class="w-4 h-4 mt-0.5 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"></path>
                                </svg>
                                <span class="line-clamp-1">{{ $notice->institution }}</span>
                            </div>

                            <!-- Resumo -->
                            <p class="text-gray-600 mb-4 line-clamp-3 flex-1 text-sm">
                                {{ $notice->summary }}
                            </p>

                            <!-- Info adicional -->
                            <div class="space-y-2 mb-4">
                                @if($notice->deadline)
                                    <div class="flex items-center gap-2 text-sm {{ $notice->isOpen() ? 'text-green-600' : 'text-red-600' }}">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                        </svg>
                                        <span>
                                            @if($notice->isOpen())
                                                @php $days = $notice->getDaysRemaining(); @endphp
                                                @if($days == 0)
                                                    Encerra hoje!
                                                @elseif($days == 1)
                                                    Encerra amanhã
                                                @else
                                                    {{ $days }} dias restantes
                                                @endif
                                            @else
                                                Encerrado em {{ $notice->getFormattedDeadline() }}
                                            @endif
                                        </span>
                                    </div>
                                @endif
                                
                                @if($notice->budget)
                                    <div class="flex items-center gap-2 text-sm text-gray-600">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                        </svg>
                                        <span class="font-medium">{{ $notice->getFormattedBudget() }}</span>
                                    </div>
                                @endif
                            </div>

                            <!-- Ações -->
                            <div class="flex items-center justify-between pt-4 border-t border-gray-200">
                                <div class="flex items-center gap-2">
                                    @if($notice->file)
                                        <a 
                                            href="{{ $notice->getFileUrl() }}" 
                                            target="_blank"
                                            class="inline-flex items-center gap-1 text-primary hover:text-primary/80 text-sm font-medium"
                                            title="Download PDF"
                                        >
                                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 10v6m0 0l-3-3m3 3l3-3m2 8H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                                            </svg>
                                            Edital
                                        </a>
                                    @endif
                                    @if($notice->external_link)
                                        <a 
                                            href="{{ $notice->external_link }}" 
                                            target="_blank"
                                            class="inline-flex items-center gap-1 text-gray-600 hover:text-primary text-sm font-medium"
                                            title="Link externo"
                                        >
                                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14"></path>
                                            </svg>
                                            Site
                                        </a>
                                    @endif
                                </div>

                                <a 
                                    href="{{ route('editais.show', $notice->slug) }}" 
                                    class="inline-flex items-center gap-2 text-primary font-semibold hover:gap-3 transition-all text-sm"
                                >
                                    Ver mais
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
            @if($publicNotices->hasPages())
                <div class="mt-12">
                    {{ $publicNotices->links() }}
                </div>
            @endif
        @else
            <!-- Estado Vazio -->
            <div class="text-center py-16">
                <svg class="w-24 h-24 text-gray-400 mx-auto mb-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                </svg>
                <h3 class="text-2xl font-bold text-gray-900 mb-2">Nenhum edital encontrado</h3>
                <p class="text-gray-600 mb-6">
                    @if(request()->hasAny(['busca', 'tipo', 'status', 'abertos']))
                        Tente ajustar os filtros de busca.
                    @else
                        Em breve publicaremos editais relacionados ao cacau.
                    @endif
                </p>
                <a href="{{ route('home') }}" class="inline-flex items-center gap-2 bg-primary text-white px-6 py-3 rounded-lg font-semibold hover:bg-opacity-90 transition-all">
                    Voltar ao Início
                </a>
            </div>
        @endif
    </div>
</section>
@endsection

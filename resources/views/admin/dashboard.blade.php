@extends('layouts.admin')

@section('page-title', 'Dashboard')

@section('content')
<div class="space-y-6">
    <!-- Welcome Card -->
    <div class="bg-white rounded-lg shadow p-4 sm:p-6">
        <h3 class="text-xl sm:text-2xl font-bold text-gray-900 mb-2">Bem-vindo, {{ Auth::user()->name }}!</h3>
        <p class="text-sm sm:text-base text-gray-600">Gerencie o conteúdo do site CI Cacau através deste painel.</p>
    </div>

    <!-- Quick Actions -->
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4 sm:gap-6">
        <a href="{{ route('admin.pages.index') }}" class="block bg-white rounded-lg shadow hover:shadow-lg transition-shadow p-4 sm:p-6 group">
            <div class="flex items-center gap-3 sm:gap-4 mb-4">
                <div class="flex items-center justify-center w-10 h-10 sm:w-12 sm:h-12 bg-primary bg-opacity-10 rounded-lg group-hover:bg-primary group-hover:bg-opacity-100 transition-colors flex-shrink-0">
                    <svg class="w-5 h-5 sm:w-6 sm:h-6 text-white group-hover:text-white transition-colors" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path>
                    </svg>
                </div>
                <div class="min-w-0">
                    <h4 class="font-semibold text-gray-900 text-sm sm:text-base">Editar Páginas</h4>
                    <p class="text-xs sm:text-sm text-gray-600">{{ count($pages) }} páginas disponíveis</p>
                </div>
            </div>
            <div class="text-xs sm:text-sm text-gray-600 group-hover:text-primary transition-colors flex items-center gap-1">
                Ver todas as páginas
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                </svg>
            </div>
        </a>

        <a href="{{ route('admin.news.index') }}" class="block bg-white rounded-lg shadow hover:shadow-lg transition-shadow p-4 sm:p-6 group">
            <div class="flex items-center gap-3 sm:gap-4 mb-4">
                <div class="flex items-center justify-center w-10 h-10 sm:w-12 sm:h-12 bg-secondary bg-opacity-20 rounded-lg group-hover:bg-secondary group-hover:bg-opacity-100 transition-colors flex-shrink-0">
                    <svg class="w-5 h-5 sm:w-6 sm:h-6 text-white group-hover:text-white transition-colors" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 20H5a2 2 0 01-2-2V6a2 2 0 012-2h10a2 2 0 012 2v1m2 13a2 2 0 01-2-2V7m2 13a2 2 0 002-2V9a2 2 0 00-2-2h-2m-4-3H9M7 16h6M7 8h6v4H7V8z"></path>
                    </svg>
                </div>
                <div class="min-w-0">
                    <h4 class="font-semibold text-gray-900 text-sm sm:text-base">Gerenciar Notícias</h4>
                    <p class="text-xs sm:text-sm text-gray-600">{{ $newsCount }} notícias ({{ $publishedNewsCount }} publicadas)</p>
                </div>
            </div>
            <div class="text-xs sm:text-sm text-gray-600 group-hover:text-secondary transition-colors flex items-center gap-1">
                Ver todas as notícias
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                </svg>
            </div>
        </a>

        <a href="{{ route('admin.researches.index') }}" class="block bg-white rounded-lg shadow hover:shadow-lg transition-shadow p-4 sm:p-6 group">
            <div class="flex items-center gap-3 sm:gap-4 mb-4">
                <div class="flex items-center justify-center w-10 h-10 sm:w-12 sm:h-12 bg-blue-100 rounded-lg group-hover:bg-blue-500 transition-colors flex-shrink-0">
                    <svg class="w-5 h-5 sm:w-6 sm:h-6 text-blue-600 group-hover:text-white transition-colors" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"></path>
                    </svg>
                </div>
                <div class="min-w-0">
                    <h4 class="font-semibold text-gray-900 text-sm sm:text-base">Pesquisa</h4>
                    <p class="text-xs sm:text-sm text-gray-600">{{ $researchCount }} itens ({{ $publishedResearchCount }} publicados)</p>
                </div>
            </div>
            <div class="text-xs sm:text-sm text-gray-600 group-hover:text-blue-500 transition-colors flex items-center gap-1">
                Gerenciar pesquisas
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                </svg>
            </div>
        </a>

        <a href="{{ route('admin.patents.index') }}" class="block bg-white rounded-lg shadow hover:shadow-lg transition-shadow p-4 sm:p-6 group">
            <div class="flex items-center gap-3 sm:gap-4 mb-4">
                <div class="flex items-center justify-center w-10 h-10 sm:w-12 sm:h-12 bg-purple-100 rounded-lg group-hover:bg-purple-500 transition-colors flex-shrink-0">
                    <svg class="w-5 h-5 sm:w-6 sm:h-6 text-purple-600 group-hover:text-white transition-colors" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"></path>
                    </svg>
                </div>
                <div class="min-w-0">
                    <h4 class="font-semibold text-gray-900 text-sm sm:text-base">Patentes</h4>
                    <p class="text-xs sm:text-sm text-gray-600">{{ $patentCount }} patentes ({{ $publishedPatentCount }} publicadas)</p>
                </div>
            </div>
            <div class="text-xs sm:text-sm text-gray-600 group-hover:text-purple-500 transition-colors flex items-center gap-1">
                Gerenciar patentes
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                </svg>
            </div>
        </a>

        <a href="{{ route('admin.public-notices.index') }}" class="block bg-white rounded-lg shadow hover:shadow-lg transition-shadow p-4 sm:p-6 group">
            <div class="flex items-center gap-3 sm:gap-4 mb-4">
                <div class="flex items-center justify-center w-10 h-10 sm:w-12 sm:h-12 bg-green-100 rounded-lg group-hover:bg-green-500 transition-colors flex-shrink-0">
                    <svg class="w-5 h-5 sm:w-6 sm:h-6 text-green-600 group-hover:text-white transition-colors" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                    </svg>
                </div>
                <div class="min-w-0">
                    <h4 class="font-semibold text-gray-900 text-sm sm:text-base">Editais</h4>
                    <p class="text-xs sm:text-sm text-gray-600">{{ $publicNoticeCount }} editais ({{ $openPublicNoticeCount }} abertos)</p>
                </div>
            </div>
            <div class="text-xs sm:text-sm text-gray-600 group-hover:text-green-500 transition-colors flex items-center gap-1">
                Gerenciar editais
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                </svg>
            </div>
        </a>

        <a href="{{ route('admin.production-costs.index') }}" class="block bg-white rounded-lg shadow hover:shadow-lg transition-shadow p-4 sm:p-6 group">
            <div class="flex items-center gap-3 sm:gap-4 mb-4">
                <div class="flex items-center justify-center w-10 h-10 sm:w-12 sm:h-12 bg-orange-100 rounded-lg group-hover:bg-orange-500 transition-colors flex-shrink-0">
                    <svg class="w-5 h-5 sm:w-6 sm:h-6 text-orange-600 group-hover:text-white transition-colors" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 7h6m0 10v-3m-3 3h.01M9 17h.01M9 14h.01M12 14h.01M15 11h.01M12 11h.01M9 11h.01M7 21h10a2 2 0 002-2V5a2 2 0 00-2-2H7a2 2 0 00-2 2v14a2 2 0 002 2z"></path>
                    </svg>
                </div>
                <div class="min-w-0">
                    <h4 class="font-semibold text-gray-900 text-sm sm:text-base">Custos de Produção</h4>
                    <p class="text-xs sm:text-sm text-gray-600">{{ $productionCostCount }} itens ({{ $publishedProductionCostCount }} publicados)</p>
                </div>
            </div>
            <div class="text-xs sm:text-sm text-gray-600 group-hover:text-orange-500 transition-colors flex items-center gap-1">
                Gerenciar custos
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                </svg>
            </div>
        </a>

        <a href="{{ route('admin.market-data.index') }}" class="block bg-white rounded-lg shadow hover:shadow-lg transition-shadow p-4 sm:p-6 group">
            <div class="flex items-center gap-3 sm:gap-4 mb-4">
                <div class="flex items-center justify-center w-10 h-10 sm:w-12 sm:h-12 bg-teal-100 rounded-lg group-hover:bg-teal-500 transition-colors flex-shrink-0">
                    <svg class="w-5 h-5 sm:w-6 sm:h-6 text-teal-600 group-hover:text-white transition-colors" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"></path>
                    </svg>
                </div>
                <div class="min-w-0">
                    <h4 class="font-semibold text-gray-900 text-sm sm:text-base">Dados de Mercado</h4>
                    <p class="text-xs sm:text-sm text-gray-600">{{ $marketDataCount }} itens ({{ $publishedMarketDataCount }} publicados)</p>
                </div>
            </div>
            <div class="text-xs sm:text-sm text-gray-600 group-hover:text-teal-500 transition-colors flex items-center gap-1">
                Gerenciar dados
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                </svg>
            </div>
        </a>
    </div>

    <!-- Pages List -->
    <div id="paginas" class="bg-white rounded-lg shadow overflow-hidden scroll-mt-6">
        <div class="p-4 sm:p-6 border-b border-gray-200 bg-gradient-to-r from-primary/5 to-secondary/5">
            <div class="flex items-center gap-3">
                <svg class="w-6 h-6 text-primary" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                </svg>
                <h3 class="text-base sm:text-lg font-semibold text-gray-900">Páginas do Site</h3>
            </div>
            <p class="text-xs sm:text-sm text-gray-600 mt-2">Clique em "Editar" para alterar o conteúdo de cada página</p>
        </div>
        <div class="divide-y divide-gray-200">
            @foreach($pages as $key => $name)
                <div class="p-4 sm:p-6 flex flex-col sm:flex-row sm:items-center justify-between gap-3 hover:bg-gray-50 transition-colors group">
                    <div class="flex items-center gap-3 min-w-0">
                        <div class="flex-shrink-0 w-10 h-10 bg-primary/10 rounded-lg flex items-center justify-center group-hover:bg-primary/20 transition-colors">
                            <svg class="w-5 h-5 text-primary" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 21h10a2 2 0 002-2V9.414a1 1 0 00-.293-.707l-5.414-5.414A1 1 0 0012.586 3H7a2 2 0 00-2 2v14a2 2 0 002 2z"></path>
                            </svg>
                        </div>
                        <div class="min-w-0">
                            <h4 class="font-semibold text-gray-900 text-sm sm:text-base">{{ $name }}</h4>
                            <p class="text-xs sm:text-sm text-gray-500">Rota: /{{ $key === 'home' ? '' : $key }}</p>
                        </div>
                    </div>
                    <a href="{{ route('admin.pages.edit', $key) }}" class="inline-flex items-center justify-center gap-2 bg-primary text-white px-4 py-2 rounded-lg text-sm font-medium hover:bg-opacity-90 transition-all flex-shrink-0 shadow-sm hover:shadow-md">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path>
                            </svg>
                        <span>Editar Conteúdo</span>
                    </a>
                </div>
            @endforeach
        </div>
    </div>
</div>
@endsection

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
        <div class="block bg-white rounded-lg shadow p-4 sm:p-6">
            <div class="flex items-center gap-3 sm:gap-4 mb-4">
                <div class="flex items-center justify-center w-10 h-10 sm:w-12 sm:h-12 bg-primary bg-opacity-10 rounded-lg flex-shrink-0">
                    <svg class="w-5 h-5 sm:w-6 sm:h-6 text-primary" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path>
                    </svg>
                </div>
                <div class="min-w-0">
                    <h4 class="font-semibold text-gray-900 text-sm sm:text-base">Editar Páginas</h4>
                    <p class="text-xs sm:text-sm text-gray-600">{{ count($pages) }} páginas disponíveis</p>
                </div>
            </div>
            <div class="text-xs sm:text-sm text-gray-600 mb-2">Veja abaixo a lista completa ↓</div>
        </div>

        <a href="{{ route('home') }}" target="_blank" class="block bg-white rounded-lg shadow hover:shadow-lg transition-shadow p-4 sm:p-6 group">
            <div class="flex items-center gap-3 sm:gap-4">
                <div class="flex items-center justify-center w-10 h-10 sm:w-12 sm:h-12 bg-secondary bg-opacity-20 rounded-lg group-hover:bg-opacity-30 transition-colors flex-shrink-0">
                    <svg class="w-5 h-5 sm:w-6 sm:h-6 text-secondary" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14"></path>
                    </svg>
                </div>
                <div class="min-w-0">
                    <h4 class="font-semibold text-gray-900 text-sm sm:text-base">Ver Site</h4>
                    <p class="text-xs sm:text-sm text-gray-600">Visualizar site público</p>
                </div>
            </div>
        </a>

        <div class="block bg-white rounded-lg shadow p-4 sm:p-6 opacity-50 cursor-not-allowed">
            <div class="flex items-center gap-3 sm:gap-4">
                <div class="flex items-center justify-center w-10 h-10 sm:w-12 sm:h-12 bg-gray-200 rounded-lg flex-shrink-0">
                    <svg class="w-5 h-5 sm:w-6 sm:h-6 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path>
                    </svg>
                </div>
                <div class="min-w-0">
                    <h4 class="font-semibold text-gray-900 text-sm sm:text-base">Em breve</h4>
                    <p class="text-xs sm:text-sm text-gray-600">Mais funcionalidades</p>
                </div>
            </div>
        </div>
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

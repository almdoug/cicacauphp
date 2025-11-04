@extends('layouts.admin')

@section('page-title', 'Editar Páginas')

@section('content')
<div class="space-y-6">
    <!-- Header Info -->
    <div class="bg-white rounded-lg shadow p-4 sm:p-6">
        <div class="flex items-center gap-3 sm:gap-4 mb-3">
            <div class="flex items-center justify-center w-12 h-12 sm:w-14 sm:h-14 bg-primary bg-opacity-10 rounded-lg flex-shrink-0">
                <svg class="w-6 h-6 sm:w-7 sm:h-7 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path>
                </svg>
            </div>
            <div>
                <h3 class="text-xl sm:text-2xl font-bold text-gray-900">Editar Páginas</h3>
                <p class="text-sm sm:text-base text-gray-600 mt-1">Gerencie o conteúdo de todas as páginas do site</p>
            </div>
        </div>
    </div>

    <!-- Pages List -->
    <div class="bg-white rounded-lg shadow overflow-hidden">
        <div class="p-4 sm:p-6 border-b border-gray-200 bg-gradient-to-r from-primary/5 to-secondary/5">
            <div class="flex items-center justify-between">
                <div class="flex items-center gap-3">
                    <svg class="w-6 h-6 text-primary" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                    </svg>
                    <div>
                        <h3 class="text-base sm:text-lg font-semibold text-gray-900">Páginas do Site</h3>
                        <p class="text-xs sm:text-sm text-gray-600 mt-0.5">{{ count($pages) }} página(s) disponível(is)</p>
                    </div>
                </div>
            </div>
        </div>
        <div class="divide-y divide-gray-200">
            @forelse($pages as $key => $name)
                <div class="p-4 sm:p-6 flex flex-col sm:flex-row sm:items-center justify-between gap-3 hover:bg-gray-50 transition-colors group">
                    <div class="flex items-center gap-3 sm:gap-4 min-w-0">
                        <div class="flex-shrink-0 w-10 h-10 sm:w-12 sm:h-12 bg-primary/10 rounded-lg flex items-center justify-center group-hover:bg-primary/20 transition-colors">
                            <svg class="w-5 h-5 sm:w-6 sm:h-6 text-primary" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 21h10a2 2 0 002-2V9.414a1 1 0 00-.293-.707l-5.414-5.414A1 1 0 0012.586 3H7a2 2 0 00-2 2v14a2 2 0 002 2z"></path>
                            </svg>
                        </div>
                        <div class="min-w-0">
                            <h4 class="font-semibold text-gray-900 text-sm sm:text-base truncate">{{ $name }}</h4>
                            <p class="text-xs sm:text-sm text-gray-500">Rota: /{{ $key === 'home' ? '' : $key }}</p>
                        </div>
                    </div>
                    <div class="flex items-center gap-2 sm:gap-3 flex-shrink-0">
                        <a href="{{ route($key) }}" target="_blank" class="inline-flex items-center justify-center gap-2 bg-white border border-gray-300 text-gray-700 px-3 sm:px-4 py-2 rounded-lg text-xs sm:text-sm font-medium hover:bg-gray-50 transition-all shadow-sm hover:shadow-md">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path>
                            </svg>
                            <span class="hidden sm:inline">Visualizar</span>
                        </a>
                        <a href="{{ route('admin.pages.edit', $key) }}" class="inline-flex items-center justify-center gap-2 bg-primary text-white px-3 sm:px-4 py-2 rounded-lg text-xs sm:text-sm font-medium hover:bg-opacity-90 transition-all shadow-sm hover:shadow-md">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path>
                            </svg>
                            <span>Editar</span>
                        </a>
                    </div>
                </div>
            @empty
                <div class="p-8 text-center">
                    <svg class="w-12 h-12 mx-auto text-gray-400 mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                    </svg>
                    <p class="text-gray-500 text-sm">Nenhuma página disponível</p>
                </div>
            @endforelse
        </div>
    </div>

    <!-- Info Card -->
    <div class="bg-blue-50 border border-blue-200 rounded-lg p-4 sm:p-5">
        <div class="flex gap-3 sm:gap-4">
            <svg class="w-5 h-5 sm:w-6 sm:h-6 text-blue-600 flex-shrink-0 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
            </svg>
            <div class="flex-1 min-w-0">
                <h4 class="text-sm sm:text-base font-semibold text-blue-900 mb-1">Como editar páginas</h4>
                <ul class="text-xs sm:text-sm text-blue-800 space-y-1 list-disc list-inside">
                    <li>Clique em "Editar" para modificar o conteúdo de uma página</li>
                    <li>Use "Visualizar" para ver a página no site antes de editar</li>
                    <li>Todas as alterações são salvas imediatamente após confirmar</li>
                </ul>
            </div>
        </div>
    </div>

    <!-- Back Button -->
    <div class="flex justify-start">
        <a href="{{ route('admin.dashboard') }}" class="inline-flex items-center gap-2 px-4 sm:px-6 py-2 sm:py-3 bg-white border border-gray-300 text-gray-700 rounded-lg text-sm sm:text-base font-medium hover:bg-gray-50 transition-colors shadow-sm">
            <svg class="w-4 h-4 sm:w-5 sm:h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path>
            </svg>
            Voltar ao Dashboard
        </a>
    </div>
</div>
@endsection

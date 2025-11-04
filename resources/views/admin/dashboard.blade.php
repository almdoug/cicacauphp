@extends('layouts.admin')

@section('page-title', 'Dashboard')

@section('content')
<div class="space-y-6">
    <!-- Welcome Card -->
    <div class="bg-white rounded-lg shadow p-6">
        <h3 class="text-2xl font-bold text-gray-900 mb-2">Bem-vindo, {{ Auth::user()->name }}!</h3>
        <p class="text-gray-600">Gerencie o conteúdo do site CI Cacau através deste painel.</p>
    </div>

    <!-- Quick Actions -->
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
        <a href="{{ route('admin.pages.edit', 'home') }}" class="block bg-white rounded-lg shadow hover:shadow-lg transition-shadow p-6 group">
            <div class="flex items-center gap-4">
                <div class="flex items-center justify-center w-12 h-12 bg-primary bg-opacity-10 rounded-lg group-hover:bg-opacity-20 transition-colors">
                    <svg class="w-6 h-6 text-primary" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path>
                    </svg>
                </div>
                <div>
                    <h4 class="font-semibold text-gray-900">Editar Página Inicial</h4>
                    <p class="text-sm text-gray-600">Alterar textos e conteúdos</p>
                </div>
            </div>
        </a>

        <a href="{{ route('home') }}" target="_blank" class="block bg-white rounded-lg shadow hover:shadow-lg transition-shadow p-6 group">
            <div class="flex items-center gap-4">
                <div class="flex items-center justify-center w-12 h-12 bg-secondary bg-opacity-20 rounded-lg group-hover:bg-opacity-30 transition-colors">
                    <svg class="w-6 h-6 text-secondary" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14"></path>
                    </svg>
                </div>
                <div>
                    <h4 class="font-semibold text-gray-900">Ver Site</h4>
                    <p class="text-sm text-gray-600">Visualizar site público</p>
                </div>
            </div>
        </a>

        <div class="block bg-white rounded-lg shadow p-6 opacity-50 cursor-not-allowed">
            <div class="flex items-center gap-4">
                <div class="flex items-center justify-center w-12 h-12 bg-gray-200 rounded-lg">
                    <svg class="w-6 h-6 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path>
                    </svg>
                </div>
                <div>
                    <h4 class="font-semibold text-gray-900">Em breve</h4>
                    <p class="text-sm text-gray-600">Mais funcionalidades</p>
                </div>
            </div>
        </div>
    </div>

    <!-- Pages List -->
    <div class="bg-white rounded-lg shadow">
        <div class="p-6 border-b border-gray-200">
            <h3 class="text-lg font-semibold text-gray-900">Páginas Disponíveis</h3>
        </div>
        <div class="divide-y divide-gray-200">
            @foreach($pages as $key => $name)
                <div class="p-6 flex items-center justify-between hover:bg-gray-50 transition-colors">
                    <div>
                        <h4 class="font-medium text-gray-900">{{ $name }}</h4>
                        <p class="text-sm text-gray-600">{{ ucfirst($key) }}</p>
                    </div>
                    <a href="{{ route('admin.pages.edit', $key) }}" class="inline-flex items-center gap-2 bg-primary text-white px-4 py-2 rounded-lg font-medium hover:bg-opacity-90 transition-all">
                        Editar
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                        </svg>
                    </a>
                </div>
            @endforeach
        </div>
    </div>
</div>
@endsection

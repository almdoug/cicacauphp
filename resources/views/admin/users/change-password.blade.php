@extends('layouts.admin')

@section('page-title', 'Alterar Senha')

@section('content')
<div class="space-y-6">
    <div class="bg-white rounded-lg shadow overflow-hidden max-w-2xl">
        <div class="p-4 sm:p-6 border-b border-gray-200">
            <h3 class="text-lg font-semibold text-gray-900">Alterar Senha</h3>
            <p class="text-sm text-gray-600 mt-1">Defina uma nova senha para {{ $user->name }}</p>
        </div>

        <form method="POST" action="{{ route('admin.users.update-password', $user) }}" class="p-4 sm:p-6 space-y-6">
            @csrf
            @method('PUT')

            <!-- User Info -->
            <div class="bg-blue-50 border border-blue-200 rounded-lg p-4">
                <div class="flex items-center gap-3">
                    <div class="flex-shrink-0 h-12 w-12 bg-primary bg-opacity-20 rounded-full flex items-center justify-center">
                        <span class="text-lg font-semibold text-primary">{{ substr($user->name, 0, 1) }}</span>
                    </div>
                    <div>
                        <p class="font-medium text-gray-900">{{ $user->name }}</p>
                        <p class="text-sm text-gray-600">{{ $user->email }}</p>
                        <p class="text-xs text-gray-500 mt-1">
                            @if($user->role === 'superadmin')
                                Super Admin
                            @elseif($user->role === 'admin')
                                Admin
                            @else
                                Publicador
                            @endif
                        </p>
                    </div>
                </div>
            </div>

            <!-- Password -->
            <div>
                <label for="password" class="block text-sm font-medium text-gray-700 mb-2">
                    Nova Senha <span class="text-red-500">*</span>
                </label>
                <input 
                    type="password" 
                    id="password"
                    name="password"
                    required
                    minlength="8"
                    class="w-full px-4 py-3 text-sm border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary focus:border-transparent @error('password') border-red-500 @enderror"
                    placeholder="Mínimo 8 caracteres"
                >
                @error('password')
                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>

            <!-- Password Confirmation -->
            <div>
                <label for="password_confirmation" class="block text-sm font-medium text-gray-700 mb-2">
                    Confirmar Nova Senha <span class="text-red-500">*</span>
                </label>
                <input 
                    type="password" 
                    id="password_confirmation"
                    name="password_confirmation"
                    required
                    minlength="8"
                    class="w-full px-4 py-3 text-sm border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary focus:border-transparent"
                    placeholder="Digite a senha novamente"
                >
            </div>

            <!-- Actions -->
            <div class="flex flex-col sm:flex-row items-stretch sm:items-center justify-end gap-3 sm:gap-4 pt-4 border-t border-gray-200">
                <a href="{{ route('admin.users.index') }}" class="px-6 py-3 border border-gray-300 text-gray-700 rounded-lg text-sm font-medium hover:bg-gray-50 transition-colors text-center">
                    Cancelar
                </a>
                <button 
                    type="submit" 
                    class="px-6 py-3 bg-primary text-white rounded-lg text-sm font-semibold hover:bg-opacity-90 transition-all shadow-lg hover:shadow-xl cursor-pointer"
                >
                    Alterar Senha
                </button>
            </div>
        </form>
    </div>
</div>
@endsection

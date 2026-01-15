@extends('layouts.admin')

@section('page-title', 'Criar Novo Usuário')

@section('content')
<div class="space-y-6">
    <div class="bg-white rounded-lg shadow overflow-hidden">
        <div class="p-4 sm:p-6 border-b border-gray-200">
            <h3 class="text-lg font-semibold text-gray-900">Novo Usuário</h3>
            <p class="text-sm text-gray-600 mt-1">Preencha os dados do novo usuário</p>
        </div>

        <form method="POST" action="{{ route('admin.users.store') }}" class="p-4 sm:p-6 space-y-6">
            @csrf

            <!-- Name -->
            <div>
                <label for="name" class="block text-sm font-medium text-gray-700 mb-2">
                    Nome Completo <span class="text-red-500">*</span>
                </label>
                <input 
                    type="text" 
                    id="name"
                    name="name"
                    value="{{ old('name') }}"
                    required
                    class="w-full px-4 py-3 text-sm border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary focus:border-transparent @error('name') border-red-500 @enderror"
                    placeholder="Digite o nome completo"
                >
                @error('name')
                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>

            <!-- Email -->
            <div>
                <label for="email" class="block text-sm font-medium text-gray-700 mb-2">
                    Email <span class="text-red-500">*</span>
                </label>
                <input 
                    type="email" 
                    id="email"
                    name="email"
                    value="{{ old('email') }}"
                    required
                    class="w-full px-4 py-3 text-sm border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary focus:border-transparent @error('email') border-red-500 @enderror"
                    placeholder="usuario@example.com"
                >
                @error('email')
                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>

            <!-- Role -->
            <div>
                <label for="role" class="block text-sm font-medium text-gray-700 mb-2">
                    Cargo/Permissão <span class="text-red-500">*</span>
                </label>
                <select 
                    id="role"
                    name="role"
                    required
                    class="w-full px-4 py-3 text-sm border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary focus:border-transparent @error('role') border-red-500 @enderror"
                >
                    <option value="">Selecione um cargo</option>
                    <option value="publicador" {{ old('role') === 'publicador' ? 'selected' : '' }}>Publicador</option>
                    <option value="admin" {{ old('role') === 'admin' ? 'selected' : '' }}>Admin</option>
                    <option value="superadmin" {{ old('role') === 'superadmin' ? 'selected' : '' }}>Super Admin</option>
                </select>
                @error('role')
                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                @enderror
                
                <div class="mt-3 space-y-2">
                    <div class="bg-purple-50 border border-purple-200 rounded-lg p-3">
                        <p class="text-xs text-purple-800"><strong>Super Admin:</strong> Acesso total ao sistema, incluindo gerenciamento de usuários e alteração de senhas.</p>
                    </div>
                    <div class="bg-blue-50 border border-blue-200 rounded-lg p-3">
                        <p class="text-xs text-blue-800"><strong>Admin:</strong> Acesso a todas as funcionalidades, exceto criação de usuários e alteração de senhas.</p>
                    </div>
                    <div class="bg-green-50 border border-green-200 rounded-lg p-3">
                        <p class="text-xs text-green-800"><strong>Publicador:</strong> Pode gerenciar notícias, pesquisas, patentes e outros conteúdos, mas não pode editar páginas.</p>
                    </div>
                </div>
            </div>

            <!-- Password -->
            <div>
                <label for="password" class="block text-sm font-medium text-gray-700 mb-2">
                    Senha <span class="text-red-500">*</span>
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
                    Confirmar Senha <span class="text-red-500">*</span>
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
                    Criar Usuário
                </button>
            </div>
        </form>
    </div>
</div>
@endsection

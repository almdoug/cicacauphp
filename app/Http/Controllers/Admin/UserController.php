<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $users = User::orderBy('created_at', 'desc')->paginate(15);
        return view('admin.users.index', compact('users'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.users.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|string|min:8|confirmed',
            'role' => 'required|in:superadmin,admin,publicador',
        ]);

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role' => $request->role,
            'is_admin' => true,
        ]);

        return redirect()->route('admin.users.index')
            ->with('success', 'Usuário criado com sucesso!');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(User $user)
    {
        // Apenas superadmin pode editar outros usuários
        if (!auth()->user()->isSuperAdmin()) {
            abort(403, 'Acesso não autorizado.');
        }

        return view('admin.users.edit', compact('user'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, User $user)
    {
        // Apenas superadmin pode editar outros usuários
        if (!auth()->user()->isSuperAdmin()) {
            abort(403, 'Acesso não autorizado.');
        }

        $request->validate([
            'name' => 'required|string|max:255',
            'email' => ['required', 'email', Rule::unique('users')->ignore($user->id)],
            'role' => 'required|in:superadmin,admin,publicador',
            'password' => 'nullable|string|min:8|confirmed',
        ]);

        $user->name = $request->name;
        $user->email = $request->email;
        $user->role = $request->role;

        if ($request->filled('password')) {
            $user->password = Hash::make($request->password);
        }

        $user->save();

        return redirect()->route('admin.users.index')
            ->with('success', 'Usuário atualizado com sucesso!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(User $user)
    {
        // Apenas superadmin pode deletar usuários
        if (!auth()->user()->isSuperAdmin()) {
            abort(403, 'Acesso não autorizado.');
        }

        // Não pode deletar a si mesmo
        if ($user->id === auth()->id()) {
            return redirect()->route('admin.users.index')
                ->with('error', 'Você não pode deletar sua própria conta!');
        }

        $user->delete();

        return redirect()->route('admin.users.index')
            ->with('success', 'Usuário removido com sucesso!');
    }

    /**
     * Show the form for changing password
     */
    public function changePassword(User $user)
    {
        // Apenas superadmin pode alterar senhas
        if (!auth()->user()->isSuperAdmin()) {
            abort(403, 'Acesso não autorizado.');
        }

        return view('admin.users.change-password', compact('user'));
    }

    /**
     * Update password
     */
    public function updatePassword(Request $request, User $user)
    {
        // Apenas superadmin pode alterar senhas
        if (!auth()->user()->isSuperAdmin()) {
            abort(403, 'Acesso não autorizado.');
        }

        $request->validate([
            'password' => 'required|string|min:8|confirmed',
        ]);

        $user->password = Hash::make($request->password);
        $user->save();

        return redirect()->route('admin.users.index')
            ->with('success', 'Senha alterada com sucesso!');
    }
}

<?php

namespace App\Console\Commands;

use App\Models\User;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Hash;

class CreateAdminUser extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'admin:create {name} {email} {password}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Criar um novo usuário administrador';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $name = $this->argument('name');
        $email = $this->argument('email');
        $password = $this->argument('password');

        // Verificar se já existe
        if (User::where('email', $email)->exists()) {
            $this->error('Um usuário com este email já existe!');
            return 1;
        }

        // Criar usuário admin
        $user = User::create([
            'name' => $name,
            'email' => $email,
            'password' => Hash::make($password),
            'is_admin' => true,
        ]);

        $this->info('Usuário administrador criado com sucesso!');
        $this->info("Nome: {$user->name}");
        $this->info("Email: {$user->email}");

        return 0;
    }
}

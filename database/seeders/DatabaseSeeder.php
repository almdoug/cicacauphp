<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

        // Criar usuário admin apenas se não existir
        if (!User::where('email', 'admin@cicacau.uesc.br')->exists()) {
            User::factory()->create([
                'name' => 'Douglas Almeida',
                'email' => 'admin@cicacau.uesc.br',
            ]);
        }

        // Seeders de conteúdo das páginas
        $this->call([
            PageContentSeeder::class,
            SobrePageContentSeeder::class,
        ]);
    }
}

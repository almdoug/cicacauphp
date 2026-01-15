<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

class UpdateExistingUsersRoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Atualizar todos os usuários existentes para superadmin
        User::where('is_admin', true)
            ->update(['role' => 'superadmin']);
    }
}

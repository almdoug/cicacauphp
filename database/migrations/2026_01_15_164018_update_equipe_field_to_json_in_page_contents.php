<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        // Não é necessário alterar a estrutura da tabela
        // O campo 'value' já é text e pode armazenar JSON
        // Apenas atualizamos o tipo para 'array' no registro existente
        DB::table('page_contents')
            ->where('page', 'sobre')
            ->where('section', 'equipe')
            ->where('key', 'conteudo')
            ->update(['type' => 'array']);
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::table('page_contents')
            ->where('page', 'sobre')
            ->where('section', 'equipe')
            ->where('key', 'conteudo')
            ->update(['type' => 'html']);
    }
};

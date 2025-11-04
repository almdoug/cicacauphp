<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use App\Models\PageContent;

return new class extends Migration
{
    /**
     * Run the migrations.
     * 
     * Remove campos obsoletos que foram consolidados em campos HTML editáveis.
     * - home/mercado: card1_text, card2_text, card3_text → cards (HTML)
     * - sobre/equipe: coordenacao_title, coordenadora_nome, etc → conteudo (HTML)
     */
    public function up(): void
    {
        // Remover campos obsoletos da seção mercado (página home)
        PageContent::where('page', 'home')
            ->where('section', 'mercado')
            ->whereIn('key', ['card1_text', 'card2_text', 'card3_text'])
            ->delete();

        // Remover campos obsoletos da seção equipe (página sobre)
        PageContent::where('page', 'sobre')
            ->where('section', 'equipe')
            ->whereIn('key', [
                'coordenacao_title',
                'coordenadora_nome',
                'coordenadora_cargo',
                'pesquisadoras_title',
                'pesquisadora_1_nome',
                'pesquisadora_2_nome'
            ])
            ->delete();
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        // Não há necessidade de reverter, pois os campos foram substituídos
        // pelos seeders atualizados com campos HTML consolidados
    }
};

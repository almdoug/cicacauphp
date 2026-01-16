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
        // Publicar todos os custos de produção existentes
        DB::table('production_costs')
            ->whereNull('published_at')
            ->update(['published_at' => now()]);

        // Publicar todos os dados de mercado existentes
        DB::table('market_data')
            ->whereNull('published_at')
            ->update(['published_at' => now()]);
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        // Não é necessário reverter, pois a ação é desejada
        // Mas se precisar, pode despublicar todos:
        // DB::table('production_costs')->update(['published_at' => null]);
        // DB::table('market_data')->update(['published_at' => null]);
    }
};

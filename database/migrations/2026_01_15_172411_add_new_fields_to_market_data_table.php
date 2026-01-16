<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('market_data', function (Blueprint $table) {
            $table->string('frequency')->nullable()->after('title'); // Frequência (Mensal, Trimestral, Anual, etc.)
            $table->string('country')->nullable()->after('region'); // País
            $table->text('comment')->nullable()->after('source'); // Comentário
            $table->timestamp('updated_at_data')->nullable()->after('comment'); // Atualizado em (para os dados)
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('market_data', function (Blueprint $table) {
            $table->dropColumn(['frequency', 'country', 'comment', 'updated_at_data']);
        });
    }
};

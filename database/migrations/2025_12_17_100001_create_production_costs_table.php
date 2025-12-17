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
        Schema::create('production_costs', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->string('title');
            $table->string('slug')->unique();
            $table->text('summary');
            $table->longText('content')->nullable();
            $table->enum('type', ['insumos', 'mao_de_obra', 'equipamentos', 'transporte', 'processamento', 'geral'])->default('geral');
            $table->string('region')->nullable(); // Região/Estado
            $table->string('period')->nullable(); // Ex: "2024", "Jan-Jun 2024"
            $table->decimal('value', 15, 2)->nullable(); // Valor em R$
            $table->string('unit')->nullable(); // Ex: "R$/ha", "R$/kg", "R$/arroba"
            $table->string('source')->nullable(); // Fonte dos dados
            $table->string('file')->nullable(); // PDF ou planilha
            $table->string('external_link')->nullable();
            $table->timestamp('published_at')->nullable();
            $table->timestamps();
            
            $table->index(['type', 'published_at']);
            $table->index(['region', 'published_at']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('production_costs');
    }
};

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
        Schema::create('market_data', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->string('title');
            $table->string('slug')->unique();
            $table->text('summary');
            $table->longText('content')->nullable();
            $table->enum('category', ['producao', 'precos', 'exportacao', 'importacao'])->default('producao');
            $table->enum('scope', ['nacional', 'internacional', 'ambos'])->default('nacional');
            $table->string('region')->nullable(); // País ou Estado
            $table->string('period')->nullable(); // Ex: "2024", "Q1 2024"
            $table->decimal('value', 15, 2)->nullable(); // Valor principal
            $table->string('unit')->nullable(); // Ex: "toneladas", "US$/ton", "R$/kg"
            $table->decimal('variation', 8, 2)->nullable(); // Variação percentual
            $table->string('source')->nullable(); // Fonte dos dados (IBGE, CEPLAC, etc.)
            $table->string('file')->nullable(); // PDF, planilha ou imagem
            $table->string('external_link')->nullable();
            $table->timestamp('published_at')->nullable();
            $table->timestamps();
            
            $table->index(['category', 'published_at']);
            $table->index(['scope', 'published_at']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('market_data');
    }
};

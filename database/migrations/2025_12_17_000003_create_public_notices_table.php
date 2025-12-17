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
        Schema::create('public_notices', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->string('title');
            $table->string('slug')->unique();
            $table->text('summary');
            $table->longText('content')->nullable();
            $table->string('institution'); // Órgão responsável
            $table->enum('type', ['pesquisa', 'extensao', 'bolsa', 'financiamento', 'outro'])->default('pesquisa');
            $table->enum('status', ['aberto', 'encerrado', 'em_analise', 'resultado'])->default('aberto');
            $table->date('opening_date')->nullable(); // Data de abertura
            $table->date('deadline')->nullable(); // Data limite para inscrição
            $table->decimal('budget', 15, 2)->nullable(); // Valor do edital
            $table->string('external_link')->nullable();
            $table->string('file')->nullable(); // PDF do edital
            $table->timestamp('published_at')->nullable();
            $table->timestamps();

            $table->index('published_at');
            $table->index('slug');
            $table->index('status');
            $table->index('deadline');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('public_notices');
    }
};

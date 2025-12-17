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
        Schema::create('researches', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->string('title');
            $table->string('slug')->unique();
            $table->enum('type', ['artigo', 'relatorio', 'livro', 'dissertacao'])->default('artigo');
            $table->text('summary');
            $table->string('authors');
            $table->string('institution')->nullable();
            $table->string('file')->nullable(); // PDF ou arquivo
            $table->string('external_link')->nullable();
            $table->year('year')->nullable();
            $table->string('doi')->nullable();
            $table->string('keywords')->nullable();
            $table->timestamp('published_at')->nullable();
            $table->timestamps();

            $table->index('published_at');
            $table->index('slug');
            $table->index('type');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('researches');
    }
};

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
        Schema::create('patents', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->string('title');
            $table->string('slug')->unique();
            $table->string('patent_number')->nullable();
            $table->text('summary');
            $table->string('inventors');
            $table->string('applicant')->nullable(); // Depositante/Titular
            $table->string('institution')->nullable();
            $table->date('filing_date')->nullable(); // Data do depósito
            $table->date('grant_date')->nullable(); // Data da concessão
            $table->enum('status', ['pendente', 'concedida', 'expirada', 'abandonada'])->default('pendente');
            $table->string('external_link')->nullable();
            $table->string('file')->nullable();
            $table->timestamp('published_at')->nullable();
            $table->timestamps();

            $table->index('published_at');
            $table->index('slug');
            $table->index('status');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('patents');
    }
};

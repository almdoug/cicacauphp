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
        Schema::create('data_series', function (Blueprint $table) {
            $table->id();
            $table->morphs('dataable'); // Para relacionamento polimórfico (production_cost ou market_data)
            $table->date('date'); // Data do ponto de dados
            $table->decimal('value', 15, 2); // Valor
            $table->string('label')->nullable(); // Rótulo opcional (ex: "Jan/2024")
            $table->text('note')->nullable(); // Nota/observação sobre este ponto específico
            $table->timestamps();
            
            $table->index(['dataable_type', 'dataable_id', 'date']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('data_series');
    }
};

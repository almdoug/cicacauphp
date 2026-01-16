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
        Schema::table('production_costs', function (Blueprint $table) {
            // Adicionar campos separados para PDF e planilha
            $table->string('file_pdf_path')->nullable()->after('comment');
            $table->string('file_pdf_name')->nullable()->after('file_pdf_path');
            $table->string('file_spreadsheet_path')->nullable()->after('file_pdf_name');
            $table->string('file_spreadsheet_name')->nullable()->after('file_spreadsheet_path');
            
            // Remover campos antigos (se existirem dados, migrar antes)
            $table->dropColumn(['file_path', 'file_name']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('production_costs', function (Blueprint $table) {
            $table->dropColumn(['file_pdf_path', 'file_pdf_name', 'file_spreadsheet_path', 'file_spreadsheet_name']);
            $table->string('file_path')->nullable();
            $table->string('file_name')->nullable();
        });
    }
};

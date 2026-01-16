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
        $tablesToIndex = [
            'production_costs',
            'market_data'
        ];

        foreach ($tablesToIndex as $tableName) {
            Schema::table($tableName, function (Blueprint $table) {
                $table->index(['title', 'published_at']);
            });
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('production_costs', function (Blueprint $table) {
            $table->dropIndex(['title', 'published_at']);
        });

        Schema::table('market_data', function (Blueprint $table) {
            $table->dropIndex(['title', 'published_at']);
        });
    }
};

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
            $table->dropForeign(['user_id']);
            $table->dropColumn([
                'category',
                'scope',
                'region',
                'period',
                'value',
                'variation',
                'summary',
                'content',
                'file',
                'external_link',
                'published_at',
                'user_id',
            ]);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('market_data', function (Blueprint $table) {
            $table->string('category')->nullable();
            $table->string('scope')->nullable();
            $table->string('region', 100)->nullable();
            $table->string('period', 50)->nullable();
            $table->decimal('value', 15, 2)->nullable();
            $table->decimal('variation', 10, 2)->nullable();
            $table->text('summary')->nullable();
            $table->longText('content')->nullable();
            $table->string('file')->nullable();
            $table->string('external_link')->nullable();
            $table->timestamp('published_at')->nullable();
            $table->foreignId('user_id')->nullable()->constrained()->onDelete('set null');
        });
    }
};

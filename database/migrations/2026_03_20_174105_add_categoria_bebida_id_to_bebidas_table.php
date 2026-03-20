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
        Schema::table('bebidas', function (Blueprint $table) {
            $table->foreignId('categoria_bebida_id')->nullable()->constrained('categorias_bebidas')->onDelete('set null');
            $table->dropColumn('tipo');
        });
    }

    public function down(): void
    {
        Schema::table('bebidas', function (Blueprint $table) {
            $table->dropForeign(['categoria_bebida_id']);
            $table->dropColumn('categoria_bebida_id');
            $table->string('tipo')->after('preco');
        });
    }
};

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
        Schema::table('pratos', function (Blueprint $table) {
            $table->foreignId('categoria_prato_id')->nullable()->constrained('categorias_pratos')->onDelete('set null');
            $table->dropColumn('categoria');
        });
    }

    public function down(): void
    {
        Schema::table('pratos', function (Blueprint $table) {
            $table->dropForeign(['categoria_prato_id']);
            $table->dropColumn('categoria_prato_id');
            $table->string('categoria')->after('preco');
        });
    }
};

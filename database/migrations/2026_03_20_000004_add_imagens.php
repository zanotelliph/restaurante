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
        Schema::table('clientes', function (Blueprint $table) {
            $table->string('imagem')->nullable()->after('endereco');
        });

        Schema::table('pratos', function (Blueprint $table) {
            $table->string('imagem')->nullable()->after('disponivel');
        });

        Schema::table('bebidas', function (Blueprint $table) {
            $table->string('imagem')->nullable()->after('disponivel');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('clientes', function (Blueprint $table) {
            $table->dropColumn('imagem');
        });

        Schema::table('pratos', function (Blueprint $table) {
            $table->dropColumn('imagem');
        });

        Schema::table('bebidas', function (Blueprint $table) {
            $table->dropColumn('imagem');
        });
    }
};

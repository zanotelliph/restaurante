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
            $table->integer('estoque')->default(0)->after('disponivel');
        });

        Schema::table('bebidas', function (Blueprint $table) {
            $table->integer('estoque')->default(0)->after('disponivel');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('pratos', function (Blueprint $table) {
            $table->dropColumn('estoque');
        });

        Schema::table('bebidas', function (Blueprint $table) {
            $table->dropColumn('estoque');
        });
    }
};

<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('pagamentos', function (Blueprint $table) {
            $table->id();
            $table->foreignId('pedido_id')->constrained('pedidos')->cascadeOnDelete()->unique();
            $table->decimal('valor', 10, 2);
            $table->string('metodo');
            $table->string('status')->default('pendente');
            $table->timestamp('pago_em')->nullable();
            $table->text('observacoes')->nullable();
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('pagamentos');
    }
};

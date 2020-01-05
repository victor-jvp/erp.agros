<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePedidosProduccionAuxiliaresTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pedidos_produccion_auxiliares', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('pedido_id');
            $table->unsignedInteger('auxiliar_id');
            $table->double('cantidad')->default(0);
            $table->double('cantidad_inicial')->default(0)->nullable();
            $table->foreign('pedido_id')->references('id')->on('pedidos_produccion');
            $table->foreign('auxiliar_id')->references('id')->on('auxiliares');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('pedidos_produccion_auxiliares');
    }
}

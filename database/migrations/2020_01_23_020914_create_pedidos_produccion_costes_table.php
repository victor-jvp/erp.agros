<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePedidosProduccionCostesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pedidos_produccion_costes', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('pedido_id');
            $table->double('recoleccion')->default(0);
            $table->double('manipulacion')->default(0);
            $table->double('comentario1')->default(0);
            $table->double('comentario2')->default(0);
            $table->double('transporte')->default(0);
            $table->double('devoluciones')->default(0);
            $table->boolean('facturado')->default(false);
            $table->boolean('cobrado')->default(false);

            $table->timestamps();

            $table->foreign('pedido_id')->references('id')->on('pedidos_produccion');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('pedidos_produccion_costes');
    }
}

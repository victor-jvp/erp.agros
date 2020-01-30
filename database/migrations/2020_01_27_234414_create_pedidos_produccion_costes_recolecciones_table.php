<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePedidosProduccionCostesRecoleccionesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pedidos_produccion_costes_recolecciones', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('pedido_id');
            $table->unsignedInteger('trazabilidad_id');
            $table->double('precio', 53, 2)->default(0);

            $table->timestamps();

            $table->foreign('trazabilidad_id')->references('id')->on('trazabilidad');
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
        Schema::dropIfExists('pedidos_produccion_costes_recolecciones');
    }
}

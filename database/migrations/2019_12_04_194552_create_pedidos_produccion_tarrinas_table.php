<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePedidosProduccionTarrinasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pedidos_produccion_tarrinas', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('pedido_id');
            $table->unsignedInteger('tarrina_id');
            $table->double('cantidad')->default(0);
            $table->double('cantidad_inicial')->default(0)->nullable();
            $table->foreign('pedido_id')->references('id')->on('pedidos_produccion');
            $table->foreign('tarrina_id')->references('id')->on('tarrinas');
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
        Schema::dropIfExists('pedidos_produccion_tarrinas');
    }
}

<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateInventarioRelTable extends Migration
{
    /**
     * Run the migrations.
     * @return void
     */
    public function up()
    {
        Schema::create('inventario_rel', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('entrada_id')->nullable();
            $table->unsignedInteger('salida_id')->nullable();
            $table->unsignedInteger('pedido_id')->nullable();
            $table->double('cantidad', 53, 2);
            $table->foreign('salida_id')->references('id')->on('inventario');
            $table->foreign('entrada_id')->references('id')->on('inventario');
            $table->foreign('pedido_id')->references('id')->on('pedidos_produccion');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('inventario_rel');
    }
}

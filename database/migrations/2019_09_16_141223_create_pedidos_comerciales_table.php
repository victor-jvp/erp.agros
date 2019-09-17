<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePedidosComercialesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pedidos_comerciales', function (Blueprint $table) {
            $table->increments('id');
            $table->string('nro_orden');
            $table->integer('anio')->nullable();
            $table->integer('semana')->nullable();
            $table->integer('dia')->nullable();
            $table->unsignedInteger('cliente_id');
            $table->unsignedInteger('producto_id');
            $table->unsignedInteger('pallet_id');
            $table->double('cantidad')->default(0);
            $table->string('etiqueta');
            $table->double('precio');
            $table->double('kilos');
            $table->text('comentarios');
            $table->unsignedInteger('estado_id');
            $table->boolean('cancelado')->default(false);
            $table->unsignedInteger('cancelado_id');
            $table->string('cancelado_coment');
            $table->foreign('cliente_id')->references('id')->on('clientes');
            $table->foreign('producto_id')->references('id')->on('productoscompuestos_det');
            $table->foreign('estado_id')->references('id')->on('pedidos_comerciales_estados');
            $table->foreign('cancelado_id')->references('id')->on('pedidos_comerciales_cat_cancelados');
            $table->foreign('pallet_id')->references('id')->on('pallets');
            $table->softDeletes();
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
        Schema::dropIfExists('pedidos_comerciales');
    }
}

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
            $table->unsignedInteger('dia_id')->nullable();
            $table->unsignedInteger('cliente_id')->nullable();
            $table->unsignedInteger('destino_id')->nullable();
            $table->unsignedInteger('producto_id')->nullable();
            $table->unsignedInteger('pallet_id')->nullable();
            $table->integer('pallet_cantidad')->default(0)->nullable();
            $table->unsignedInteger('transporte_id')->nullable();
            $table->double('cajas')->default(0);
            $table->string('etiqueta')->nullable();
            $table->double('precio')->default(0);
            $table->double('kilos')->default(0);
            $table->text('comentarios')->nullable();
            $table->unsignedInteger('estado_id')->nullable();
            $table->unsignedInteger('cancelado_id')->nullable();
            $table->string('cancelado_coment')->nullable();
            $table->foreign('dia_id')->references('id')->on('cat_dias_semana');
            $table->foreign('cliente_id')->references('id')->on('clientes');
            $table->foreign('destino_id')->references('id')->on('clientes_destinos');
            $table->foreign('cultivo_id')->references('id')->on('cultivos');
            $table->foreign('producto_id')->references('id')->on('productoscompuestos_det');
            $table->foreign('estado_id')->references('id')->on('pedidos_comerciales_estados');
            $table->foreign('cancelado_id')->references('id')->on('pedidos_comerciales_cat_cancelados');
            $table->foreign('pallet_id')->references('id')->on('pallets');
            $table->foreign('transporte_id')->references('id')->on('transportes');
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

<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProductoscompuestosCajasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('productoscompuestos_cajas', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('det_id');
            $table->unsignedInteger('caja_id');
            $table->double('cantidad');
            $table->foreign('det_id')->references('id')->on('productosCompuestos_det');
            $table->foreign('caja_id')->references('id')->on('cajas');
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
        Schema::dropIfExists('productoscompuestos_cajas');
    }
}

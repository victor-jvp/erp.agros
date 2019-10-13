<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProductoscompuestosPaletsAuxiliaresTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('productoscompuestos_palets_auxiliares', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('det_id');
            $table->unsignedInteger('pallet_model_id');
            $table->unsignedInteger('auxiliar_id');
            $table->double('cantidad');            
            $table->foreign('det_id')->references('id')->on('productosCompuestos_det');
            $table->foreign('pallet_model_id')->references('id')->on('pallets_models');
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
        Schema::dropIfExists('productoscompuestos_palets_auxiliares');
    }
}

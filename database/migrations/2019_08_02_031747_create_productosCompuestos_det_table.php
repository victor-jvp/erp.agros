<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProductosCompuestosDetTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('productosCompuestos_det', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('compuesto_id');
            $table->foreign('compuesto_id')->references('id')->on('productosCompuestos_cab');
            $table->string('variable', 105);
            $table->unsignedInteger('caja_id');
            $table->foreign('caja_id')->references('id')->on('cajas');
            $table->double('euro_cantidad');
            $table->double('euro_kg');
            $table->unsignedInteger('euro_pallet_id');
            $table->foreign('euro_pallet_id')->references('id')->on('pallets');
            $table->double('grand_cantidad');
            $table->double('grand_kg');
            $table->unsignedInteger('grand_pallet_id');
            $table->foreign('grand_pallet_id')->references('id')->on('pallets');
            $table->string('cestas');
            $table->string('tapas');
            $table->string('cantoneras');
            $table->unsignedInteger('cubre_id');
            $table->foreign('cubre_id')->references('id')->on('cubres');
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
        Schema::dropIfExists('productosCompuestos_det');
    }
}

<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateEntradasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('entradas', function (Blueprint $table) {
            $table->increments('id');
            $table->string('nro_lote', 10);
            $table->dateTime('fecha');
            $table->unsignedInteger('pallet_id')->nullable();
            $table->unsignedInteger('caja_id')->nullable();
            $table->double('cantidad');
            $table->string('nro_albaran', 35);
            $table->dateTime('fecha_albaran');
            $table->boolean('transporte_adecuado')->default(false);
            $table->boolean('control_plagas')->default(false);
            $table->boolean('estado_pallets')->default(false);
            $table->boolean('ficha_tecnica')->default(false);
            $table->boolean('material_daniado')->default(false);
            $table->boolean('material_limpio')->default(false);
            $table->boolean('control_grapas')->default(false);
            $table->boolean('cantidad_conforme')->default(false);
            $table->unsignedInteger('proveedor_id');
            $table->foreign('pallet_id')->references('id')->on('pallets');
            $table->foreign('caja_id')->references('id')->on('cajas');
            $table->foreign('proveedor_id')->references('id')->on('proveedores');

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
        Schema::dropIfExists('entradas');
    }
}

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
            $table->string('variable', 105)->nullable();
            $table->unsignedInteger('caja_id')->nullable();
//            $table->foreign('caja_id')->references('id')->on('cajas');
            $table->double('euro_cantidad')->default('0')->nullable();
            $table->double('euro_kg')->default('0')->nullable();
            $table->unsignedInteger('euro_pallet_id')->nullable()->nullable();
//            $table->foreign('euro_pallet_id')->references('id')->on('pallets');
            $table->double('grand_cantidad')->default('0')->nullable();
            $table->double('grand_kg')->default('0')->nullable();
            $table->unsignedInteger('grand_pallet_id')->nullable();
//            $table->foreign('grand_pallet_id')->references('id')->on('pallets');
            $table->string('cestas')->nullable();
            $table->string('tapas')->nullable();
            $table->string('cantoneras')->nullable();
            $table->unsignedInteger('cubre_id')->nullable();
//            $table->foreign('cubre_id')->references('id')->on('cubres');
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

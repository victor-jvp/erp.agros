<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProductosCompuestosDetTable extends Migration
{
    /**
     * Run the migrations.
     * @return void
     */
    public function up()
    {
        Schema::create('productoscompuestos_det', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('compuesto_id')->nullable();
            $table->string('variable', 105)->nullable();
            $table->unsignedInteger('caja_id')->nullable();
            $table->double('euro_cantidad')->default('0')->nullable();
            $table->double('euro_kg')->default('0')->nullable();
            $table->string('euro_cantoneras')->nullable();
            $table->unsignedInteger('euro_cubre_id')->nullable();
            $table->double('euro_cubre_cantidad')->default('0')->nullable();
            $table->double('grand_cantidad')->default('0')->nullable();
            $table->double('grand_kg')->default('0')->nullable();
            $table->string('grand_cantoneras')->nullable();
            $table->unsignedInteger('grand_cubre_id')->nullable();
            $table->double('grand_cubre_cantidad')->default('0')->nullable();
            $table->foreign('compuesto_id')->references('id')->on('productoscompuestos_cab');
            $table->foreign('caja_id')->references('id')->on('cajas');
            $table->foreign('euro_cubre_id')->references('id')->on('cubres');
            $table->foreign('grand_cubre_id')->references('id')->on('cubres');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('productoscompuestos_det');
    }
}

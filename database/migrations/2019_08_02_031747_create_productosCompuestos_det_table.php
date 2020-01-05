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
            $table->double('kg')->default('0')->nullable();
            $table->unsignedInteger('cubre_id')->nullable();
            $table->double('cubre_cantidad')->default('0')->nullable();
            $table->double('euro_cantidad')->default('0')->nullable();
            $table->double('grand_cantidad')->default('0')->nullable();
            $table->foreign('compuesto_id')->references('id')->on('productoscompuestos_cab');
            $table->foreign('caja_id')->references('id')->on('cajas');
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

<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProductosCompuestosCabTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('productoscompuestos_cab', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('cultivo_id');
            $table->string('compuesto');
            $table->date('fecha');
            $table->foreign('cultivo_id')->references('id')->on('cultivos');
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
        Schema::dropIfExists('productoscompuestos_cab');
    }
}

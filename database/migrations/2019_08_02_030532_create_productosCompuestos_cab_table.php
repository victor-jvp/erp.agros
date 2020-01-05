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
            $table->unsignedInteger('cultivo_id')->nullable();
            $table->string('compuesto');
            $table->date('fecha');
            $table->timestamps();
            $table->foreign('cultivo_id')->references('id')->on('cultivos');
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

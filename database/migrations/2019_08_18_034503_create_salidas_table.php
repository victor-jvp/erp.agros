<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSalidasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('salidas', function (Blueprint $table) {
            $table->increments('id');
            $table->string('nro_salida', 10);
            $table->dateTime('fecha');
            $table->unsignedInteger('pallet_id')->nullable();
            $table->unsignedInteger('caja_id')->nullable();
            $table->double('cantidad');
            $table->foreign('pallet_id')->references('id')->on('pallets');
            $table->foreign('caja_id')->references('id')->on('cajas');
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
        Schema::dropIfExists('salidas');
    }
}

<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTransportesAdjuntosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('transportes_adjuntos', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('transporte_id');
            $table->date('fecha');
            $table->string('descripcion');
            $table->string('tipo');
            $table->string('file');
            $table->foreign('transporte_id')->references('id')->on('transportes');
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
        Schema::dropIfExists('transportes_adjuntos');
    }
}

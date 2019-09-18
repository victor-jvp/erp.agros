<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTransportesContactosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('transportes_contactos', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('transporte_id');
            $table->string('descripcion', 155);
            $table->string('telefono', 55);
            $table->string('email');
            $table->foreign('transporte_id')->references('id')->on('transportes');
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
        Schema::dropIfExists('transportes_contactos');
    }
}

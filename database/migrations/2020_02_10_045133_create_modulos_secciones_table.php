<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateModulosSeccionesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('modulos_secciones', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('modulo_id');
            $table->string('name', 55);
            $table->string('url', 105);
            $table->boolean('isActive')->default(true);

            $table->timestamps();

            $table->foreign('modulo_id')->references('id')->on('modulos');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('modulos_secciones');
    }
}

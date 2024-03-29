<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePrevisionesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('previsiones', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('anio')->nullable();
            $table->integer('semana')->nullable();
            $table->integer('dia')->nullable();
            $table->unsignedInteger('finca_id')->nullable();
            $table->unsignedInteger('trazabilidad_id')->nullable();
            $table->double('cantidad_inicial');
            $table->double('cantidad');
            $table->string('registro', 3);
            $table->foreign('finca_id')->references('id')->on('fincas');
            $table->foreign('trazabilidad_id')->references('id')->on('trazabilidad');
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
        Schema::dropIfExists('previsiones');
    }
}
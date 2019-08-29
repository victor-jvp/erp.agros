<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePrevisionesComentariosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('previsiones_comentarios', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('anio')->nullable();
            $table->integer('semana')->nullable();
            $table->unsignedInteger('finca_id')->nullable();
            $table->unsignedInteger('cultivo_id')->nullable();
            $table->text('comentario')->nullable();
            $table->foreign('finca_id')->references('id')->on('fincas');
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
        Schema::dropIfExists('previsiones_comentarios');
    }
}

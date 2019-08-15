<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTrazabilidadTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('trazabilidad', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('finca_id');
            $table->unsignedInteger('parcela_id');
            $table->unsignedInteger('cultivo_id');
            $table->unsignedInteger('variedad_id');
            $table->foreign('finca_id')->references('id')->on('fincas');
            $table->foreign('parcela_id')->references('id')->on('parcelas');
            $table->foreign('cultivo_id')->references('id')->on('cultivos');
            $table->foreign('variedad_id')->references('id')->on('variedades');
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
        Schema::dropIfExists('trazabilidad');
    }
}

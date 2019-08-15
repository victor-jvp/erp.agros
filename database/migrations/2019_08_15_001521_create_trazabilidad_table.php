<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTrazabilidadTable extends Migration
{
    /**
     * Run the migrations.
     * @return void
     */
    public function up()
    {
        Schema::create('trazabilidad', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('parcela_id');
            $table->unsignedInteger('variedad_id');
            $table->unsignedInteger('marca_id');
            $table->foreign('parcela_id')->references('id')->on('parcelas');
            $table->foreign('variedad_id')->references('id')->on('variedades');
            $table->foreign('marca_id')->references('id')->on('marcas');
            $table->softDeletes();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('trazabilidad');
    }
}

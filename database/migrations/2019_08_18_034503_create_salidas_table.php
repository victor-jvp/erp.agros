<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSalidasTable extends Migration
{
    /**
     * Run the migrations.
     * @return void
     */
    public function up()
    {
        Schema::create('salidas', function (Blueprint $table) {
            $table->increments('id');
            $table->string('nro_salida', 10);
            $table->dateTime('fecha');
            $table->enum('categoria', [
                'Caja',
                'Palet',
                'Cubre',
                'Auxiliar',
                'Tarrina'
            ]);
            $table->unsignedInteger('categoria_id')->nullable();
            $table->double('cantidad');
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
        Schema::dropIfExists('salidas');
    }
}

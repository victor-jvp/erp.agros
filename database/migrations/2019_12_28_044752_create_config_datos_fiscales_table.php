<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateConfigDatosFiscalesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('config_datos_fiscales', function (Blueprint $table) {
            $table->increments('id');
            $table->string('cif', 15);
            $table->string('razon_social');
            $table->string('nombre_comercial')->nullable();
            $table->string('direccion')->nullable();
            $table->string('telefono', 15)->nullable();
            $table->string('email',55)->nullable();
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
        Schema::dropIfExists('config_datos_fiscales');
    }
}

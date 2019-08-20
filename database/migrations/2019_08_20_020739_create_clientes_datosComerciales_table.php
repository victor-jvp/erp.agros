<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateClientesDatosComercialesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('clientes_datosComerciales', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger("cliente_id");
            $table->string("nombre");
            $table->string("direccion");
            $table->string("telefono");
            $table->string("email");
            $table->foreign('cliente_id')->references('id')->on('clientes');
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
        Schema::dropIfExists('clientes_datosComerciales');
    }
}

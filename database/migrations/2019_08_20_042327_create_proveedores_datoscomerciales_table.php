<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProveedoresDatoscomercialesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('proveedores_datoscomerciales', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger("proveedor_id");
            $table->string("nombre");
            $table->string("direccion");
            $table->string("telefono");
            $table->string("email");
            $table->foreign('proveedor_id')->references('id')->on('proveedores');
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
        Schema::dropIfExists('proveedores_datoscomerciales');
    }
}

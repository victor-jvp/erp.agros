<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTzEntradasTable extends Migration
{
    /**
     * Run the migrations.
     * @return void
     */
    public function up()
    {
        Schema::create('tz_entradas', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('proveedor_id');
            $table->unsignedInteger('producto_id');
            $table->date('fecha')->nullable()->useCurrent();
            $table->string('albaran', 35)->nullable()->default(null);
            $table->string('traza', 35)->nullable()->default(null);
            $table->double('cantidad', 15, 3)->nullable()->default(0);
            $table->string('variedad')->nullable()->default(null);
            $table->timestamps();
            $table->softDeletes();

            $table->foreign('proveedor_id')->references('id')->on('tz_proveedores');
            $table->foreign('producto_id')->references('id')->on('productoscompuestos_det');
        });
    }

    /**
     * Reverse the migrations.
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('tz_entradas');
    }
}

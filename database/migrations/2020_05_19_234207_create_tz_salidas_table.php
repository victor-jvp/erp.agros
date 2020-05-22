<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTzSalidasTable extends Migration
{
    /**
     * Run the migrations.
     * @return void
     */
    public function up()
    {
        Schema::create('tz_salidas', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->date('fecha')->nullable()->useCurrent();
            $table->string('traza', 35)->nullable()->default(null);
            $table->unsignedBigInteger('entrada_id');
            $table->unsignedBigInteger('proveedor_id');
            $table->unsignedInteger('producto_id');
            $table->unsignedInteger('cliente_id');
            $table->double('cajas', 15, 3)->nullable()->default(0);
            $table->double('cantidad', 15, 3)->nullable()->default(0);
            $table->double('precio', 15, 3)->nullable()->default(0);

            $table->double('coste', 15, 3)->nullable()->default(0);
            $table->double('comision', 15, 3)->nullable()->default(0);
            $table->double('precio_liquidacion', 15, 3)->nullable()->default(0);
            $table->boolean('pagada')->nullable()->default(false);
            $table->timestamps();
            $table->softDeletes();

            $table->foreign('cliente_id')->references('id')->on('clientes');
            $table->foreign('producto_id')->references('id')->on('productoscompuestos_det');
            $table->foreign('proveedor_id')->references('id')->on('tz_proveedores');
            $table->foreign('entrada_id')->references('id')->on('tz_entradas');
        });
    }

    /**
     * Reverse the migrations.
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('tz_salidas');
    }
}

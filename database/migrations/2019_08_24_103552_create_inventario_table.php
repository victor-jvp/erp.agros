<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateInventarioTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('inventario', function (Blueprint $table) {
            $table->increments('id');
            $table->enum('tipo_mov', [
                'E',
                'S'
            ]);
            $table->dateTime('fecha');
            $table->string('nro_lote', 10);
            $table->enum('categoria', [
                'Caja',
                'Palet',
                'Cubre',
                'Auxiliar',
                'Tarrina'
            ]);
            $table->unsignedInteger('categoria_id');
            $table->double('cantidad');
            $table->string('nro_albaran', 35)->nullable();
            $table->dateTime('fecha_albaran')->nullable();
            $table->boolean('transporte_adecuado')->default(false);
            $table->boolean('control_plagas')->default(false);
            $table->boolean('estado_pallets')->default(false);
            $table->boolean('ficha_tecnica')->default(false);
            $table->boolean('material_daniado')->default(false);
            $table->boolean('material_limpio')->default(false);
            $table->boolean('control_grapas')->default(false);
            $table->boolean('cantidad_conforme')->default(false);
            $table->unsignedInteger('proveedor_id')->nullable();
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
        Schema::dropIfExists('inventario');
    }
}

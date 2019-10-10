<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class RemoveCantidadesFromProductoscompuestosDetTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('productoscompuestos_det', function (Blueprint $table) {
            //Remover columnas cantidades de productoscompuestos_det
            $table->dropColumn(['euro_cantidad', 'grand_cantidad']);
        });
    }

    public function down()
    {
        Schema::table('productoscompuestos_det', function (Blueprint $table) {
            //Agregar columnas cantidades de productoscompuestos_det
            $table->double('euro_cantidad')->default('0')->nullable();
            $table->double('grand_cantidad')->default('0')->nullable();
        });
    }
}

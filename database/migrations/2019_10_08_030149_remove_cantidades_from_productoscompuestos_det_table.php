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
}

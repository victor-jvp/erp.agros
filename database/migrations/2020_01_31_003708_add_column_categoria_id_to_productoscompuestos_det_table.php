<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddColumnCategoriaIdToProductoscompuestosDetTable extends Migration
{
    /**
     * Run the migrations.
     * @return void
     */
    public function up()
    {
        Schema::table('productoscompuestos_det', function (Blueprint $table) {
            //
            if (!Schema::hasColumn('productoscompuestos_det', 'categoria_id')) {
                $table->unsignedInteger('categoria_id')->after('variable');
                $table->foreign('categoria_id')->references('id')->on('categorias');
            }
        });
    }

    /**
     * Reverse the migrations.
     * @return void
     */
    public function down()
    {
        Schema::table('productoscompuestos_det', function (Blueprint $table) {
            //
            $table->dropForeign(['categoria_id']);
            $table->dropColumn('categoria_id');
        });
    }
}

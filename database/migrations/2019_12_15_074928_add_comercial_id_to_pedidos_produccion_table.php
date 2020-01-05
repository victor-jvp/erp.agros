<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddComercialIdToPedidosProduccionTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('pedidos_produccion', function (Blueprint $table){
            $table->unsignedInteger('comercial_id')->nullable()->after('id');
            $table->foreign('comercial_id')->references('id')->on('pedidos_comerciales');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('pedidos_produccion', function (Blueprint $table){
            $table->dropForeign(['comercial_id']);
            $table->dropColumn('comercial_id');
        });
    }
}

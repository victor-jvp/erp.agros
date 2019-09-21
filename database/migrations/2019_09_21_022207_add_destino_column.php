<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddDestinoColumn extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('pedidos_comerciales', function (Blueprint $table) {
            if (Schema::hasColumn('pedidos_comerciales', 'cliente_id')) {
                $table->dropColumn('cliente_id');
            }
            $table->unsignedInteger('destino_id');
            $table->foreign('destino_id')->references('id')->on('clientes_destinos');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        if (Schema::hasColumn('pedidos_comerciales', 'destino_id')) {
            Schema::table('pedidos_comerciales', function (Blueprint $table) {
                $table->dropColumn('destino_id');
            });
        }
    }
}

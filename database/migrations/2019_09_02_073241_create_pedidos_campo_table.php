<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePedidosCampoTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pedidos_campo', function (Blueprint $table) {
            $table->increments('id');
            $table->date('fecha');
            $table->integer('nro_lote_pedido');
            $table->integer('sort')->nullable();
            $table->string('encargado', 155)->nullable();
            $table->unsignedInteger('parcela_id');
            $table->string('formato')->nullable();
            $table->string('caja')->nullable();
            $table->string('kilos')->nullable();
            $table->string('cliente')->nullable();
            $table->text('comentario')->nullable();
            $table->foreign('parcela_id')->references('id')->on('parcelas');
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
        Schema::dropIfExists('pedidos_campo');
    }
}

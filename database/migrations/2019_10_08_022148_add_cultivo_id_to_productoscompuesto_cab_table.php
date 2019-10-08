<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddCultivoIdToProductoscompuestoCabTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('productoscompuestos_cab', function (Blueprint $table){
            $table->unsignedInteger('cultivo_id')->nullable()->default(null);
            $table->foreign('cultivo_id')->references('id')->on('cultivos');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
    }
}

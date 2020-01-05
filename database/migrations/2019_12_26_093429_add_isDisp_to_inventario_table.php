<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddIsDispToInventarioTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //
        Schema::table('inventario', function (Blueprint $table){
            $table->boolean('isDisp')->default(true)->after('tipo_mov');
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
        Schema::table('inventario', function (Blueprint $table){
            $table->dropColumn('isDisp');
        });
    }
}

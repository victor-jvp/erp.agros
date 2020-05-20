<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTzEntradasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tz_entradas', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->date('fecha')->nullable()->default(new DateTime());
            $table->string('traza', 35)->nullable()->default(null);
            $table->unsignedBigInteger('proveedor_id');
            $table->unsignedBigInteger('articulo_id');
            $table->double('cantidad', 15, 8)->nullable()->default(0);
            $table->string('variedad')->nullable()->default(null);
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('tz_entradas');
    }
}

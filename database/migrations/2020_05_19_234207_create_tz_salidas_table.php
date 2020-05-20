<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTzSalidasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tz_salidas', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->date('fecha')->nullable()->default(new DateTime());
            $table->string('traza', 35)->nullable()->default(null);
            $table->unsignedBigInteger('proveedor_id');
            $table->unsignedBigInteger('articulo_id');
            $table->double('cajas', 15, 8)->nullable()->default(0);
            $table->double('cantidad', 15, 8)->nullable()->default(0);
            $table->double('precio', 15, 8)->nullable()->default(0);
            $table->unsignedBigInteger('cliente_id');
            $table->double('coste', 15, 8)->nullable()->default(0);
            $table->double('comision', 15, 8)->nullable()->default(0);
            $table->double('precio_liquidacion', 15, 8)->nullable()->default(0);
            $table->boolean('pagada')->nullable()->default(false);
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
        Schema::dropIfExists('tz_salidas');
    }
}

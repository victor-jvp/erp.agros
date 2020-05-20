<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTzProveedoresTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tz_proveedores', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('proveedor', 255)->nullable()->default(null);
            $table->string('domicilio', 255)->nullable()->default(null);
            $table->string('poblacion', 255)->nullable()->default(null);
            $table->string('cif', 255)->nullable()->default(null);
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
        Schema::dropIfExists('tz_proveedores');
    }
}

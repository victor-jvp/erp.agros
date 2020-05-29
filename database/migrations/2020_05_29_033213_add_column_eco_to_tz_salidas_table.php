<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddColumnEcoToTzSalidasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('tz_salidas', function (Blueprint $table) {
            //
            $table->boolean('eco')->default(false)->after('precio_liquidacion');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('tz_salidas', function (Blueprint $table) {
            //
            $table->removeColumn('eco');
        });
    }
}

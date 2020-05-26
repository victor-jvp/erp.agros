<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddColumnMermaToTzEntradasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('tz_entradas', function (Blueprint $table) {
            //
            $table->double('merma', 15, 3)->nullable()->default(0)->after('variedad');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('tz_entradas', function (Blueprint $table) {
            //
            $table->dropColumn('merma');
        });
    }
}

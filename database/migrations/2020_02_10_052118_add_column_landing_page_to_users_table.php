<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddColumnLandingPageToUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('users', function (Blueprint $table) {
            //
            if (!Schema::hasColumn('users', 'landing_seccion_id')) {
                $table->unsignedInteger('landing_seccion_id')->default(null)->nullable()->after('cargo');
                $table->foreign('landing_seccion_id')->references('id')->on('modulos_secciones');
            }
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropForeign(['landing_seccion_id']);
            $table->dropColumn('landing_seccion_id');
        });
    }
}

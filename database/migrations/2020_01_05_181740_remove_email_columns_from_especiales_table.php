<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class RemoveEmailColumnsFromEspecialesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('especiales', function (Blueprint $table) {
            //
            $table->dropColumn('mail_driver');
            $table->dropColumn('mail_host');
            $table->dropColumn('mail_port');
            $table->dropColumn('mail_username');
            $table->dropColumn('mail_password');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('especiales', function (Blueprint $table) {
            //
            $table->string('mail_driver')->nullable();
            $table->string('mail_host')->nullable();
            $table->string('mail_port')->nullable();
            $table->string('mail_username')->nullable();
            $table->string('mail_password')->nullable();
        });
    }
}

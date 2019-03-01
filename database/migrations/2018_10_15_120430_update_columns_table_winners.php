<?php

use \App\Database\Migration\CustomBlueprint as Blueprint;

class UpdateColumnsTableWinners extends \App\Database\Migration\Base
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('winners', function (Blueprint $table) {
            $table->dropColumn('application_id');
            $table->integer('serial_number_id')->length(11)->comment('シリアナンバーID')->after('id');
            $table->integer('present_id')->length(11)->comment('プレゼントID')->after('serial_number_id');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('winners', function (Blueprint $table) {
            $table->integer('application_id')->length(11)->comment('応募ID');
            $table->dropColumn('serial_number_id');
            $table->dropColumn('present_id');
        });
    }
}

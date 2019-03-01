<?php

use \App\Database\Migration\CustomBlueprint as Blueprint;

class ChangeColumnsTableApplications extends \App\Database\Migration\Base
{
    protected $_table = 'applications';
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table($this->getTable(), function (Blueprint $table) {
            $table->dropColumn('serial_number_id');
            $table->dropColumn('gift_id');
            $table->integer('present_id')->length(11)->comment('プレゼントID');
            $table->integer('serial_number')->length(11)->comment('シリアルナンバー');
            $table->string('key')->length(64)->comment('シリアルナンバーキー');
            $table->string('salt')->length(256)->comment('シリアルナンバーsalt');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table($this->getTable(), function (Blueprint $table) {
            $table->integer('serial_number_id')->length(11)->comment('シリアルナンバー');
            $table->integer('gift_id')->length(11)->comment('プレゼントID');
            $table->dropColumn('key');
            $table->dropColumn('salt');
            $table->dropColumn('present_id');
            $table->dropColumn('serial_number');
        });
    }
}

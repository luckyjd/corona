<?php

use \App\Database\Migration\CustomBlueprint as Blueprint;

class UpdateColumnsTableApplications extends \App\Database\Migration\Base
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
            $table->dropColumn('key');
            $table->dropColumn('salt');
            $table->dropColumn('serial_number');
            $table->integer('serial_number_id')->length(11)->comment('シリアナンバーID')->after('present_id');
            $table->char('status', 1)->default(0)->comment('応募ステータス')->after('serial_number_id');
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
            $table->string('key')->length(64)->comment('シリアルナンバーキー')->after('present_id');
            $table->string('salt')->length(256)->comment('シリアルナンバーsalt')->after('key');
            $table->integer('serial_number')->length(11)->comment('シリアルナンバー')->after('salt');
            $table->dropColumn('serial_number_id');
            $table->dropColumn('status');
        });
    }
}

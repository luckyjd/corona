<?php

use \App\Database\Migration\CustomBlueprint as Blueprint;

class ChangeColumnsTableWinners extends \App\Database\Migration\Base
{
    protected $_table = 'winners';
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
            $table->dropColumn('user_id');
            $table->integer('application_id')->length(11)->comment('応募ID');
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
            $table->integer('user_id')->length(11)->comment('ユーザーID');
            $table->dropColumn('application_id');
        });
    }
}

<?php

use \App\Database\Migration\CustomBlueprint as Blueprint;

class RemoveColumnsTableSerialNumbers extends \App\Database\Migration\Base
{
    protected $_table = 'serial_numbers';
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table($this->getTable(), function (Blueprint $table) {
            $table->dropColumn('salt');
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
            $table->string('salt', 256)->comment('シリアルナンバーsalt');
        });
    }
}

<?php

use \App\Database\Migration\CustomBlueprint as Blueprint;

class DropTableSerialNumbers extends \App\Database\Migration\Base
{
    protected $_table = 'serial_numbers';
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::dropIfExists($this->getTable());
    }

    public function down()
    {
        Schema::create($this->getTable(), function (Blueprint $table) {
            $table->increments('id');
            $table->integer('serial_number_id')->length(11)->comment('シリアルナンバー');
            $table->integer('gift_id')->length(11)->comment('プレゼントID');
            $table->integer('user_id')->length(11)->comment('ユーザーID');
            $table->actionBy();
            $table->timestamps();
            $table->softDeletes();
        });
    }
}

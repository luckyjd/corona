<?php

use \App\Database\Migration\CustomBlueprint as Blueprint;

class CreateTableWinners extends \App\Database\Migration\Create
{
    protected $_table = 'winners';
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
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

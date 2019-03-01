<?php

use \App\Database\Migration\CustomBlueprint as Blueprint;

class CreateTableSerialNumbers extends \App\Database\Migration\Create
{
    protected $_table = 'serial_numbers';
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create($this->getTable(), function (Blueprint $table) {
            $table->increments('id');
            $table->string('serial_number', 256)->comment('シリアルナンバー');
            $table->string('key', 64)->comment('key');
            $table->char('status', 1)->comment('プレゼントID');
            $table->actionBy();
            $table->timestamps();
            $table->softDeletes();
        });
    }
}

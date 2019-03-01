<?php

use \App\Database\Migration\CustomBlueprint as Blueprint;

class CreateTablePresents extends \App\Database\Migration\Create
{
    protected $_table = 'presents';
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create($this->getTable(), function (Blueprint $table) {
            $table->increments('id');
            $table->string('name', 512)->comment('プレゼント名');
            $table->integer('quantity')->comment('点数');
            $table->integer('remain_quantity')->comment('残り点数');
            $table->integer('exchange_point')->comment('応募ポイント(枚数)');
            $table->text('introduction')->comment('説明文');
            $table->string('image', 512)->comment('画像URL');
            $table->actionBy();
            $table->timestamps();
            $table->softDeletes();
        });
    }
}

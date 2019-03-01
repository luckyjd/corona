<?php

use \App\Database\Migration\CustomBlueprint as Blueprint;

class CreateShopsTable extends \App\Database\Migration\Create
{
    protected $_table = 'shops';
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create($this->getTable(), function (Blueprint $table) {
            $table->increments('id');
            $table->string('code', 64)->comment('店舗コード')->unique();
            $table->string('tel', 13)->comment('店舗名');
            $table->string('name', 128)->comment('電話番号');
            $table->string('zip_code', 7)->comment('郵便番号');
            $table->string('pref', 128)->comment('都道府県');
            $table->string('address', 128)->comment('番地');
            $table->string('address1', 128)->comment('市区')->nullable();
            $table->string('address2', 128)->comment('町村')->nullable();
            $table->string('address3', 32)->comment('建物名・部屋番号')->nullable();
            $table->actionBy();
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('shops');
    }
}

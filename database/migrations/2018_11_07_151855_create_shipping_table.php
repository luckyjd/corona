<?php

use \App\Database\Migration\CustomBlueprint as Blueprint;

class CreateShippingTable extends \App\Database\Migration\Create
{
    protected $_table = 'shipping';
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create($this->getTable(), function (Blueprint $table) {
            $table->increments('id');
            $table->integer('application_id')->length(11)->comment('ユーザーID');
            $table->string('first_name', 64)->comment('First name');
            $table->string('last_name', 64)->comment('Last name');
            $table->string('email', 256)->comment('メールアドレス');
            $table->string('zip_code', 7)->comment('郵便番号')->nullable();
            $table->integer('pref_id')->length(11)->nullable();
            $table->string('address', 256)->comment('住所')->nullable();
            $table->string('address1', 256)->comment('都道府県')->nullable();
            $table->string('address2', 256)->comment('市区町村')->nullable();
            $table->string('address3', 256)->comment('番地・建物名')->nullable();
            $table->string('tel', 13)->comment('電話番号')->nullable();
            $table->string('store_list', 512)->comment('氏名')->nullable();
            $table->actionBy();
            $table->timestamps();
            $table->softDeletes();
        });
    }
    public function down()
    {
        Schema::dropIfExists($this->getTable());
    }

}

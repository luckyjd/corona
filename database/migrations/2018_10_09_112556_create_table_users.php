<?php

use \App\Database\Migration\CustomBlueprint as Blueprint;

class CreateTableUsers extends \App\Database\Migration\Create
{
    protected $_table = 'users';
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create($this->getTable(), function (Blueprint $table) {
            $table->increments('id');
            $table->string('first_name', 64)->comment('First name');
            $table->string('last_name', 64)->comment('Last name');
            $table->string('email', 256)->comment('メールアドレス');
            $table->string('password', 64)->comment('パスワード');
            $table->integer('point')->length(11)->default(0);
            $table->string('address', 256)->comment('住所');
            $table->string('tel', 13)->comment('電話番号');
            $table->string('zip_code', 7)->comment('郵便番号');
            $table->string('address1', 256)->comment('都道府県');
            $table->string('address2', 256)->comment('市区町村')->nullable();
            $table->string('address3', 256)->comment('番地・建物名')->nullable();
            $table->actionBy();
            $table->timestamps();
            $table->softDeletes();
        });
    }
}

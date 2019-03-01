<?php

use \App\Database\Migration\CustomBlueprint as Blueprint;

class ChangeNullableToShopsTable extends \App\Database\Migration\Base
{
    protected $_table = 'shops';
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table($this->getTable(), function (Blueprint $table) {
            $table->string('code', 64)->comment('店舗コード')->nullable()->change();
            $table->string('tel', 32)->comment('店舗名')->nullable()->change();
            $table->string('name', 128)->comment('電話番号')->nullable()->change();
            $table->string('pref', 128)->comment('都道府県')->nullable()->change();
            $table->string('address', 128)->comment('番地')->nullable()->change();
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
            $table->string('code', 64)->comment('店舗コード')->nullable(false)->change();
            $table->string('tel', 13)->comment('店舗名')->nullable(false)->change();
            $table->string('name', 128)->comment('電話番号')->nullable(false)->change();
            $table->string('pref', 128)->comment('都道府県')->nullable(false)->change();
            $table->string('address', 128)->comment('番地')->nullable(false)->change();
        });
    }
}

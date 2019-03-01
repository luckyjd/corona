<?php

use \App\Database\Migration\CustomBlueprint as Blueprint;

class ChangeColumnsTableUsers extends \App\Database\Migration\Base
{
    protected $_table = 'users';
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table($this->getTable(), function (Blueprint $table) {
            $table->string('address', 256)->comment('住所')->nullable()->change();
            $table->string('tel', 13)->comment('電話番号')->nullable()->change();
            $table->string('zip_code', 7)->comment('郵便番号')->nullable()->change();
            $table->string('address1', 256)->comment('都道府県')->nullable()->change();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {

    }
}

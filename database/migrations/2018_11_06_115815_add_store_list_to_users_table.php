<?php

use \App\Database\Migration\CustomBlueprint as Blueprint;

class AddStoreListToUsersTable extends \App\Database\Migration\Base
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
            $table->string('store_list', 512)->comment('氏名')->after('address3');
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
            $table->dropColumn('store_list');
        });
    }
}

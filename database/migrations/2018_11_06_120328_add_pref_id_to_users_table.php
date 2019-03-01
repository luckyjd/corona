<?php

use \App\Database\Migration\CustomBlueprint as Blueprint;

class AddPrefIdToUsersTable extends \App\Database\Migration\Base
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
            $table->integer('pref_id')->length(11)->after('tel');
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
            $table->dropColumn('pref_id');
        });
    }
}

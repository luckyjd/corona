<?php

use \App\Database\Migration\CustomBlueprint as Blueprint;

class AddColumnsTableAdminUsers extends \App\Database\Migration\Base
{
    protected $_table = 'admin_users';
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table($this->getTable(), function (Blueprint $table) {
            $table->string('name', 64)->comment('氏名')->after('id');
            $table->string('password', 64)->comment('パスワード')->after('email');
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
            $table->dropColumn('name');
            $table->dropColumn('password');
        });
    }
}

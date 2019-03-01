<?php

use \App\Database\Migration\CustomBlueprint as Blueprint;

class RemoveColumnsTableAdminUsers extends \App\Database\Migration\Base
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
            $table->dropColumn('login_password');
            $table->dropColumn('avatar');
            $table->dropColumn('groups');
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
            $table->string('avatar')->after('email');
            $table->string('login_password', 64)->after('avatar');
            $table->string('groups', 32)->after('login_password');
        });
    }
}

<?php

use \App\Database\Migration\CustomBlueprint as Blueprint;

class CreateAdminUsersTable extends \App\Database\Migration\Create
{
    protected $_table = 'admin_users';

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create($this->getTable(), function (Blueprint $table) {
            $table->increments('id');
            $table->string('email', 256);
            $table->string('avatar');
            $table->string('login_password', 64);
            $table->string('groups', 32);
            $table->actionBy();
            $table->timestamps();
            $table->softDeletes();
        });
    }
}

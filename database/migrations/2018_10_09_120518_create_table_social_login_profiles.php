<?php

use \App\Database\Migration\CustomBlueprint as Blueprint;

class CreateTableSocialLoginProfiles extends \App\Database\Migration\Create
{
    protected $_table = 'social_login_profiles';
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create($this->getTable(), function (Blueprint $table) {
            $table->increments('id');
            $table->integer('user_id')->length(11)->comment('ユーザーID');
            $table->string('facebook_id', 255)->comment('Facebook ID')->nullable();
            $table->string('google_id', 255)->comment('Google ID')->nullable();
            $table->string('twitter_id', 255)->comment('Twitter ID')->nullable();
            $table->actionBy();
            $table->timestamps();
            $table->softDeletes();
        });
    }
}

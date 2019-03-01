<?php

use \App\Database\Migration\CustomBlueprint as Blueprint;

class ChangeTelToShopsTable extends \App\Database\Migration\Base
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
            $table->string('tel', 32)->comment('店舗名')->change();
            $table->string('zip_code', 12)->comment('郵便番号')->nullable()->change();
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
            $table->string('tel', 13)->comment('店舗名')->change();
            $table->string('zip_code', 7)->comment('郵便番号')->change();
        });
    }
}

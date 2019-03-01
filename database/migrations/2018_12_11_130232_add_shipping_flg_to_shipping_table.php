<?php

use \App\Database\Migration\CustomBlueprint as Blueprint;

class AddShippingFlgToShippingTable extends \App\Database\Migration\Base
{
    protected $_table = 'shipping';
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table($this->getTable(), function (Blueprint $table) {
            $table->string('shipping_flg', 1)->nullable()->after('store_list');
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
            $table->dropColumn('shipping_flg');
        });
    }
}

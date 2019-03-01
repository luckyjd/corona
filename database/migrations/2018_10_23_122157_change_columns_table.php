<?php

use \App\Database\Migration\CustomBlueprint as Blueprint;

class ChangeColumnsTable extends \App\Database\Migration\Base
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        // drop winners
        Schema::dropIfExists('winners');

        Schema::table('applications', function (Blueprint $table) {
            $table->dropColumn('serial_number_id');
        });

        Schema::table('presents', function (Blueprint $table) {
            $table->dropColumn('exchange_point');
            $table->char('type');
        });

        Schema::table('serial_numbers', function (Blueprint $table) {
            $table->integer('user_id')->nullable()->comment('ユーザーID');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        // create winners
        Schema::create('winners', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('serial_number_id')->length(11)->comment('シリアルナンバー');
            $table->integer('user_id')->length(11)->comment('ユーザーID');
            $table->integer('present_id')->length(11)->comment('プレゼントID');
            $table->actionBy();
            $table->timestamps();
            $table->softDeletes();
        });

        Schema::table('applications', function (Blueprint $table) {
            $table->integer('serial_number_id')->length(11)->comment('シリアルナンバー');
        });

        Schema::table('presents', function (Blueprint $table) {
            $table->dropColumn('type');
            $table->integer('exchange_point')->comment('応募ポイント(枚数)');
        });

        Schema::table('serial_numbers', function (Blueprint $table) {
            $table->dropColumn('user_id');
        });
    }
}

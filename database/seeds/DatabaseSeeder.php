<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Eloquent::unguard();
        $this->call('AdminUserInfoTableSeeder');
    }
}

class AdminUserInfoTableSeeder extends Seeder
{
    public function run()
    {
        \App\Model\Entities\AdminUserInfo::truncate();
        App\Model\Entities\AdminUserInfo::create(array(
            'email' => 'admin@gmail.com',
            'password' => 'admin123',
            'name' => 'administrator',
        ));
    }

}



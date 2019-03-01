<?php

namespace App\Repositories;

use App\Model\Entities\Shops;
use App\Repositories\Base\CustomRepository;

class ShopRepository extends CustomRepository
{
    function model()
    {
        return Shops::class;
    }

    public function validator()
    {
        return \App\Validators\Shop::class;
    }

    public function getShopForFrontend($query = array())
    {
        return  $query = $this->search($query)->get();
    }
}
<?php

namespace App\Repositories;

use App\Model\Entities\AdminUserInfo;
use App\Repositories\Base\CustomRepository;

class AdminUserInfoRepository extends CustomRepository
{
    /**
     * Specify Model class name
     *
     * @return string
     */
    function model()
    {
        return AdminUserInfo::class;
    }

    public function validator()
    {
        return \App\Validators\AdminUserInfo::class;
    }

    public function getListEmail()
    {
        return $this->pluck('email', 'id')->toArray();
    }
}
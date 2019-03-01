<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Base\BackendController;
use App\Repositories\AdminUserInfoRepository;

/**
 * Class AdminController
 * @package App\Http\Controllers\Backend
 */
class AdminController extends BackendController
{
    /**
     * AdminController constructor.
     * @param AdminUserInfoRepository $adminUserInfoRepository
     */
    public function __construct(AdminUserInfoRepository $adminUserInfoRepository)
    {
        parent::__construct();
        $this->setRepository($adminUserInfoRepository);
        $this->setBackUrlDefault('dashboard.index');
        $this->setConfirmRoute('admin.confirm');
    }

    /**
     * @param $id
     * @return mixed
     */
    protected function _findEntityForUpdate($id)
    {
        $entity = parent::_findEntityForUpdate($id);
        empty($entity->password) ? $entity->setPasswordAttribute($entity->getOriginal('password')) : null;
        return $entity;
    }
}

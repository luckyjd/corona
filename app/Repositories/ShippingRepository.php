<?php

namespace App\Repositories;

use App\Model\Entities\Application;
use App\Model\Entities\Shipping;
use App\Model\Entities\User;
use App\Repositories\Base\CustomRepository;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Input;

class ShippingRepository extends CustomRepository
{
    function model()
    {
        return Shipping::class;
    }

    public function validator()
    {
        return \App\Validators\Shipping::class;
    }

    public function getShippingByApplicationId($applicationId)
    {
        return $this->where('application_id', '=', $applicationId)->first();
    }
    public function getListForBackend($query)
    {
        $fields = [
            'id',
            'ins_datetime',
            'upd_datetime',
            DB::raw(Shipping::getQuaColumn('application_id'). ' as application_id'),
            DB::raw(Shipping::getQuaColumn('email') . ' as user_email'),
            DB::raw(Shipping::getQuaColumn('pref_id') . ' as pref_id'),
            DB::raw(Shipping::getQuaColumn('address') . ' as address'),
            DB::raw(Shipping::getQuaColumn('address1') . ' as address1'),
            DB::raw(Shipping::getQuaColumn('zip_code') . ' as zip_code'),
            DB::raw(Shipping::getQuaColumn('store_list') . ' as store_list'),
            DB::raw(Shipping::getQuaColumn('shipping_flg') . ' as shipping_flg'),
            DB::raw(Application::getQuaColumn('status') . ' as status'),
        ];
        $builder = $this->search($query, $fields)
            ->leftJoin(Application::getTableName(), Application::getQuaColumn('id'), Shipping::getQuaColumn('application_id'))
            ->when(array_get($query, 'email'), function ($q) use ($query) {
                $email = array_get($query, 'email');
                return $q->whereRaw(Shipping::getQuaColumn('email') . ' like "' . $email . '%")');
            });

        $shippingFlg = Input::get('shipping_flg_eq');
        if ($shippingFlg != 1 && $shippingFlg != '') {
            $builder->orwhereNull(Shipping::getQuaColumn('shipping_flg'));
        }
        return $builder->paginate(backendPaginate('per_page.' . $this->getModel()->getTable(), backendPaginate('per_page.default', 20)));
    }
}
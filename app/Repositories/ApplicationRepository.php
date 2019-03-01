<?php

namespace App\Repositories;

use App\Model\Entities\Application;
use App\Model\Entities\Present;
use App\Model\Entities\Shipping;
use App\Model\Entities\User;
use App\Repositories\Base\CustomRepository;
use Illuminate\Support\Facades\DB;

class ApplicationRepository extends CustomRepository
{
    function model()
    {
        return Application::class;
    }

    public function validator()
    {
        return \App\Validators\Application::class;
    }

    public function getListForBackend($query)
    {
        $fields = [
            'id',
            'status',
            'ins_datetime',
            'upd_datetime',
            DB::raw('IF(status = ' . getConstant('STATUS_WIN') . ',' . Shipping::getQuaColumn('email') . ',' . User::getQuaColumn('email') . ') as user_email'),
            DB::raw('IF(status = ' . getConstant('STATUS_WIN') . ',' . Shipping::getQuaColumn('pref_id') . ',' . User::getQuaColumn('pref_id') . ') as pref_id'),
            DB::raw('IF(status = ' . getConstant('STATUS_WIN') . ',' . Shipping::getQuaColumn('address') . ',' . User::getQuaColumn('address') . ') as address'),
            DB::raw('IF(status = ' . getConstant('STATUS_WIN') . ',' . Shipping::getQuaColumn('address1') . ',' . User::getQuaColumn('address1') . ') as address1'),
            DB::raw('IF(status = ' . getConstant('STATUS_WIN') . ',' . Shipping::getQuaColumn('zip_code') . ',' . User::getQuaColumn('zip_code') . ') as zip_code'),
            DB::raw(Shipping::getQuaColumn('store_list') .' as store_list'),
            DB::raw(Shipping::getQuaColumn('shipping_flg') .' as shipping_flg'),
        ];
        return $this->search($query, $fields)
            ->join(User::getTableName(), Application::getQuaColumn('user_id'), User::getQuaColumn('id'))
            ->leftJoin(Shipping::getTableName(), Application::getQuaColumn('id'), Shipping::getQuaColumn('application_id'))
            ->join(Present::getTableName(), Application::getQuaColumn('present_id'), Present::getQuaColumn('id'))
            ->when(array_get($query, 'email'), function ($q) use ($query){
                $email = array_get($query, 'email');
                return $q->whereRaw('(IF(status = ' . getConstant('STATUS_WIN') . ',' . Shipping::getQuaColumn('email') . ',' . User::getQuaColumn('email') . ') like "' . $email . '%")');
            })
            ->paginate(backendPaginate('per_page.' . $this->getModel()->getTable(), backendPaginate('per_page.default', 20)));
    }

    public function getApplicationWined()
    {
        return $this->where($this->getQuaColumn('status'), '=', getConstant('STATUS_WIN'))->join(User::getTableName(), Application::getQuaColumn('user_id'), User::getQuaColumn('id'))->get()->count();
    }

    public function getWinnerForDashboard()
    {
        return $this->where($this->getQuaColumn('status'), '=', getConstant('STATUS_WIN'))->with('user')->orderBy($this->getQuaColumn('id'), 'DESC')->join(User::getTableName(), Application::getQuaColumn('user_id'), User::getQuaColumn('id'))->limit(10)->get();
    }

    public function getApplicationInCurrentMonth()
    {
        return $this->where('ins_datetime', '>=', date('Y-m') . '-01 00:00:00')
                    ->where('ins_datetime', '<=', date('Y-m') . '-' . date('t') . ' 23:59:59')
                    ->get();
    }

    public function getApplicationIsWinedInCurrentMonth()
    {
        return $this->join(User::getTableName(), Application::getQuaColumn('user_id'), User::getQuaColumn('id'))->where(Application::getQuaColumn('upd_datetime'), '>=', date('Y-m') . '-01 00:00:00')
            ->where(Application::getQuaColumn('upd_datetime'), '<=', date('Y-m') . '-' . date('t') . ' 23:59:59')
            ->where('status', '=', getConstant('STATUS_WIN'))
            ->get();
    }
}
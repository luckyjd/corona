<?php

namespace App\Repositories;

use App\Model\Entities\SocialLoginProfile;
use App\Model\Entities\User;
use App\Repositories\Base\CustomRepository;
use Illuminate\Support\Facades\DB;

class UserRepository extends CustomRepository
{
    function model()
    {
        return User::class;
    }

    public function validator()
    {
        return \App\Validators\User::class;
    }

    public function getListForBackend($query)
    {
        $concat = 'CONCAT(' . User::getQuaColumn('last_name') . ', " ", ' . User::getQuaColumn('first_name') . ')';
        $column = array('*', DB::raw($concat . ' as name'), DB::raw(SocialLoginProfile::getQuaColumn('facebook_id').' as sns_id'));
        return $this->search($query, $column)->leftJoin(SocialLoginProfile::getTableName(), SocialLoginProfile::getQuaColumn('user_id'), $this->getQuaColumn('id'))->when(array_get($query, 'name'), function ($q) use ($query, $concat) {
            return $q->where(DB::raw($concat), 'LIKE', $query['name'] . '%');
        })->paginate(backendPaginate('per_page.' . $this->getModel()->getTable(), backendPaginate('per_page.default', 20)));
    }

    public function getTotalPoints()
    {
        return (int)$this->select(DB::raw('sum(point) as point'))->where('point', '>', 0)->first()->point;
    }

    public function findById($id)
    {
        return $this->where('id', '=', $id)->first();
    }
}
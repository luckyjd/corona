<?php

namespace App\Repositories;

use App\Repositories\Base\CustomRepository;
use App\Model\Entities\SerialNumber;
use App\Validators\SerialNumber as SerialNumberValidator;
use Illuminate\Support\Facades\DB;

class SerialNumberRepository extends CustomRepository
{
    function model()
    {
        return SerialNumber::class;
    }

    public function validator()
    {
        return SerialNumberValidator::class;
    }

    public function getSerialNumber($query)
    {
        $serialNumber = $this->search($query, ['*'])->whereNull('user_id')->first();
        return $serialNumber;
    }
    public function countSerialNumber()
    {
        $query = $this->select(DB::raw('count(*) as count'))->whereNull('user_id')->first()->count;
        return $query;
    }
}

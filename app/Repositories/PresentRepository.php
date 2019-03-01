<?php

namespace App\Repositories;

use App\Model\Entities\Present;
use App\Repositories\Base\CustomRepository;
use Illuminate\Support\Facades\DB;

class PresentRepository extends CustomRepository
{
    function model()
    {
        return Present::class;
    }

    public function validator()
    {
        return \App\Validators\Present::class;
    }

    public function getListForBackend($query)
    {
        return $this->search($query)->with('applications')
            ->paginate(backendPaginate('per_page.' . $this->getModel()->getTable(), backendPaginate('per_page.default', 20)));
    }

    public function getPresentsOnePtForFrontend($query = array())
    {
        return $this->search($query)
            ->presentOnePt()
            ->paginate(frontendPaginate('per_page.' . $this->getModel()->getTable(), frontendPaginate('per_page.default', 20)));
    }

    public function getPresentsFivePtForFrontend($query = array())
    {
        return $this->search($query)
            ->presentFivePt()
            ->paginate(frontendPaginate('per_page.' . $this->getModel()->getTable(), frontendPaginate('per_page.default', 20)));
    }

    public function getRemainPresent($presentId)
    {
        $present = $this->search(['id_eq' => $presentId])->first();

        if (!$present || $present->remain_quantity <= 0) {
            return null;
        }

        return $present;
    }

    public function sumRemainPresents()
    {
        return (int)$this->select(DB::raw('sum(remain_quantity) as remain_quantity'))->where('quantity', '>', 0)->where('remain_quantity', '>', 0)->first()->remain_quantity;
    }

    public function decreasePresentForOne($presentId)
    {
        $present = $this->search(['id_eq' => $presentId])->first();
        $present->remain_quantity -= 1;
        $present->save();
    }

    public function findById($id)
    {
        return $this->where('id', $id)->first(); // entity or null
    }
}
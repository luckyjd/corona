<?php

namespace App\Services;

use App\Repositories\PresentRepository;
use App\Services\Base\BaseService;

class PresentService extends BaseService
{
    public function __construct(PresentRepository $presentRepository)
    {
        $this->setRepository($presentRepository);
    }

    public function createNumberUser($totalPresent)
    {
        return rand(1, $totalPresent);
    }

    /**
     * @param $limit
     * @param $max
     */
    public function createArrRandomWin($remain, $total)
    {
        $remain = $remain < $total ? $remain : $total;
        $i = 1;
        $result = [];
        while ($i == 1) {
            $a = rand(1, $total);
            if (!in_array($a, $result)) {
                array_push($result, $a);
            }
            if (count($result) == $remain) {
                $i = 2;
            }
        }

        return $result;
    }

    public function isWin($totalRemainPresents, $total)
    {
        if ($totalRemainPresents >= $total) {
            return true;
        }

        $numberUser = $this->createNumberUser($total);
        $arrRandomWin = $this->createArrRandomWin($totalRemainPresents, $total);

        if (!in_array($numberUser,$arrRandomWin)) {
            return false;
        }

        return true;
    }
}
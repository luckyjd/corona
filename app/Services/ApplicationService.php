<?php

namespace App\Services;

use App\Repositories\ApplicationRepository;
use App\Services\Base\BaseService;

class ApplicationService extends BaseService
{
    public function __construct(ApplicationRepository $applicationRepository)
    {
        $this->setRepository($applicationRepository);
    }

    public function getDataForLineChart()
    {
        $colorChartApplication = getConstant('COLOR_CHART_APPLICATION');
        $colorChartApplicationWined = getConstant('COLOR_CHART_APPLICATION_WINED');
        $data = [
            [
                'label' => getConstant('LABEL_TOTAL_APPLICATION'),
                'backgroundColor' => 'rgba(237, 231, 246, 0.5)',
                'borderColor' => $colorChartApplication,
                'pointBackgroundColor' => $colorChartApplication,
                'data' => $this->_getApplicationInCurrentMonth(),
            ],
            [
                'label' => getConstant('LABEL_APPLICATION_WINED'),
                'backgroundColor' => 'rgba(237, 231, 246, 0.5)',
                'borderColor' => $colorChartApplicationWined,
                'pointBackgroundColor' => $colorChartApplicationWined,
                'data' => $this->_getApplicationIsWinedInCurrentMonth(),
            ]
        ];
        return $data;
    }

    protected function _getApplicationInCurrentMonth()
    {
        $apps = $this->getRepository()->getApplicationInCurrentMonth();
        return $this->_filterDataForChart($apps, true);
    }

    protected function _getApplicationIsWinedInCurrentMonth()
    {
        $apps = $this->getRepository()->getApplicationIsWinedInCurrentMonth();
        return $this->_filterDataForChart($apps, false);
    }

    protected function _filterDataForChart($apps, $isSetDateInsert = true)
    {
        $r = [];
        if (empty($apps)) {
            return $r;
        }

        $lastDay = (int) date('t');

        for ($i = 1; $i <= $lastDay; $i ++) {
            $value = 0;
            foreach ($apps as $app) {
                $date = ($isSetDateInsert) ? $app->getDateInsert() : $app->getDateUpdate();
                if ($date != $i) {
                    continue;
                }
                $value++;
            }
            $r[$i] = $value;
        }
        return array_values($r);
    }
}
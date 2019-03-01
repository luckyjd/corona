<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Base\BackendController;
use App\Repositories\ApplicationRepository;
use App\Repositories\UserRepository;
use App\Services\ApplicationService;

/**
 * Class DashboardController
 * @package App\Http\Controllers\Backend
 */
class DashboardController extends BackendController
{
    protected $_userRepository;

    public function setUserRepository($userRepository) {
        $this->_userRepository = $userRepository;
    }

    public function getUserRepository()
    {
        return $this->_userRepository;
    }

    protected $_applicationService;

    public function setService($applicationService) {
        $this->_applicationService = $applicationService;
    }

    public function getService()
    {
        return $this->_applicationService;
    }

    public function __construct(ApplicationRepository $applicationRepository, UserRepository $userRepository, ApplicationService $applicationService)
    {
        parent::__construct();
        $this->setRepository($applicationRepository);
        $this->setUserRepository($userRepository);
        $this->setService($applicationService);
    }

    public function index()
    {
        $overview = $this->_getDataForOverview();
        $charts = $this->getService()->getDataForLineChart();
        $winners = $this->getRepository()->getWinnerForDashboard();
        $this->setViewData(['overview' => $overview, 'charts' => $charts, 'winners' => $winners]);
        return $this->render();
    }

    protected function _getDataForOverview()
    {
        $data = [];
        $data['total_user'] = $this->getUserRepository()->count();
        $data['total_application'] = $this->getRepository()->count();
        $data['application_wined'] = $this->getRepository()->getApplicationWined();
        return $data;
    }


}

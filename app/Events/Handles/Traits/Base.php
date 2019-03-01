<?php

namespace App\Events\Handles\Traits;

trait Base
{

    protected $_service = null;

    /**
     * @return null
     */
    public function getService()
    {
        return $this->_service;
    }

    /**
     * @param null $service
     */
    public function setService($service)
    {
        $this->_service = $service;
    }


    public function __construct()
    {
    }

    public function handle($data)
    {
        return $data;
    }
}
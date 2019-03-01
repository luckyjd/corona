<?php

namespace App\Jobs;

use Illuminate\Contracts\Queue\ShouldQueue;

use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Foundation\Bus\Dispatchable;

class Base implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected $_params = [];

    public function getParam($key, $default = null)
    {
        return array_get($this->_params, $key, $default);
    }

    /**
     * @return array
     */
    public function getParams()
    {
        return $this->_params;
    }

    /**
     * @param array $params
     */
    public function setParams($params)
    {
        $this->_params = $params;
    }

    public function __construct()
    {
        $this->setParams(func_get_args());
    }

    public function getRepository($name)
    {
        $container = $this->getJob()->getContainer();
        return new $name($container);
    }


    public function getJob()
    {
        return $this->job;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        try {
            $this->_handle();
        } catch (\Exception $e) {
            logError($e->getMessage());
        } catch (\Throwable $e) {
            logError($e->getMessage());
        } catch (\Error $e) {
            logError($e->getMessage());
        }
    }

    protected function _handle()
    {
        return true;
    }
}

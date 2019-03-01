<?php

namespace App\Helpers;


class RouteRegistrar extends \Illuminate\Routing\RouteRegistrar
{
    protected $_uris = [];

    /**
     * @return array
     */
    public function getUris()
    {
        return $this->_uris;
    }

    /**
     * @param array $uris
     */
    public function setUris($uris)
    {
        $this->_uris = $uris;
    }

    public function hasUri($uri)
    {
        return isset($this->_uris[$uri]);
    }

    /**
     * The attributes that can be set through this class.
     *
     * @var array
     */
    protected $allowedAttributes = [
        'as', 'domain', 'middleware', 'name', 'namespace', 'prefix', 'extension'
    ];

    protected function registerRoute($method, $uri, $action = null)
    {
        $groups = $this->router->getGroupStack();
        $r = null;
        foreach ($groups as $group) {
            $exs = (array)array_get($group, 'extension', []);
            if (empty($group) || empty($exs)) {
                $r = parent::registerRoute($method, $uri, $action);
                continue;
            }
            foreach ($exs as $ex) {
                if (!$ex) {
                    continue;
                }
                $uriO = $uri;
                $uriO .= $ex;
                $uriMethod = $uriO . $method;
                if ($this->hasUri($uriMethod)) {
                    continue;
                }
                $this->_uris[$uriMethod] = $uriMethod;
                $r = parent::registerRoute($method, $uriO, $action);
            }
        }
        return $r ? $r : parent::registerRoute($method, $uri, $action);
    }
}

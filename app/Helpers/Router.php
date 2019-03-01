<?php

namespace App\Helpers;

use Illuminate\Support\Traits\Macroable;

class Router
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

    use Macroable {
        __call as macroCall;
    }

    public function __call($method, $parameters)
    {
        $allow = ['get', 'post', 'any', 'put', 'patch', 'delete', 'options', 'any', 'match'];
        if (in_array($method, $allow)) {
            return $this->_buildUri(app('router')->getGroupStack(), $method, $parameters);
        }

        if ($method == 'resource') {
            return $this->build($method, $parameters);
        }

        if (static::hasMacro($method)) {
            return $this->macroCall($method, $parameters);
        }

        if ($method == 'middleware') {
            return (new RouteRegistrar(app('router')))->attribute($method, is_array($parameters[0]) ? $parameters[0] : $parameters);
        }

        return (new RouteRegistrar(app('router')))->attribute($method, $parameters[0]);
    }

    protected function _buildUri($groups, $method, $parameters)
    {
        $r = null;
        foreach ($groups as $group) {
            $exs = (array)array_get($group, 'extension', []);
            if (empty($group) || empty($exs)) {
                $r = $this->build($method, $parameters);
                continue;
            }
            foreach ($exs as $ex) {
                if(!$ex){
                    continue;
                }
                $params = $parameters;
                if ($method == 'match') {
                    $uri = $params[1] = $params[1] . $ex;
                } else {
                    $uri = $params[0] . $ex;
                    $params[0] = $uri;
                }
                $uriMethod = $uri.$method;
                if ($this->hasUri($uriMethod)) {
                    continue;
                }
                $this->_uris[$uriMethod] = $uriMethod;
                $r = $this->build($method, $params);
            }
        }
        return $r ? $r : $this->build($method, $parameters);
    }

    public function build($method, $parameters)
    {
        return call_user_func_array([\Illuminate\Support\Facades\Route::class, $method], $parameters);
    }
}

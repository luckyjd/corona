<?php

namespace App\Helpers\Facades;

use Illuminate\Support\Facades\Facade as IlluminateFacade;

/**
 * Class ExtendedRoute
 * @package App\Helpers\Facades
 */
class Route extends IlluminateFacade
{
    /**
     * Get the registered name of the component.
     *
     * @return string
     */
    protected static function getFacadeAccessor()
    {
        return 'myrouter';
    }

}
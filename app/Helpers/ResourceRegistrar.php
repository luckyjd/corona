<?php

namespace App\Helpers;

use Illuminate\Routing\ResourceRegistrar as OriginalRegistrar;
use Illuminate\Routing\Router;
/**
 * Class ResourceRegistrar
 * @package App\Helpers
 */
class ResourceRegistrar extends OriginalRegistrar
{

    /**
     * @var array
     */
    protected $resourceDefaults = array('getList', 'exportCsv', 'massDestroy', 'confirm', 'valid', 'index', 'create', 'store', 'show', 'edit', 'update', 'destroy');


    public function __construct(Router $router)
    {
        parent::__construct($router);
        $this->router =  app('myrouter');
        $v = [
            'create' => 'create',
            'edit' => 'edit',
            'confirm' => 'confirm',
            'massDestroy' => 'mass-destroy',
            'exportCsv' => 'export-csv',
            'getList' => 'get-list'
        ];
        static::verbs($v);
    }

    protected function addResourceGetList($name, $base, $controller, $options)
    {
        $uri = $this->getResourceUri($name) . '/' . static::$verbs['getList'];

        $action = $this->getResourceAction($name, $controller, 'getList', $options);

        return $this->router->get($uri, $action);
    }

    /**
     * Add the confirm method for a resourceful route.
     *
     * @param  string $name
     * @param  string $base
     * @param  string $controller
     * @param  array $options
     * @return \Illuminate\Routing\Route
     */
    protected function addResourceExportCsv($name, $base, $controller, $options)
    {
        $uri = $this->getResourceUri($name) . '/' . static::$verbs['exportCsv'];

        $action = $this->getResourceAction($name, $controller, 'exportCsv', $options);

        return $this->router->get($uri, $action);
    }

    /**
     * Add the valid method for a resourceful route.
     *
     * @param  string $name
     * @param  string $base
     * @param  string $controller
     * @return void
     */
    protected function addResourceValid($name, $base, $controller, $options = [])
    {
        $uri = $this->getResourceUri($name) . '/valid/{' . $base . '?}';

        return $this->router->post($uri, $this->getResourceAction($name, $controller, 'valid', $options));
    }

    /**
     * Add the confirm method for a resourceful route.
     *
     * @param  string $name
     * @param  string $base
     * @param  string $controller
     * @param  array $options
     * @return \Illuminate\Routing\Route
     */
    protected function addResourceConfirm($name, $base, $controller, $options)
    {
        $uri = $this->getResourceUri($name) . '/' . static::$verbs['confirm'];

        $action = $this->getResourceAction($name, $controller, 'confirm', $options);

        return $this->router->get($uri, $action);
    }

    /**
     * Add the confirm method for a resourceful route.
     *
     * @param  string $name
     * @param  string $base
     * @param  string $controller
     * @param  array $options
     * @return \Illuminate\Routing\Route
     */
    protected function addResourceMassDestroy($name, $base, $controller, $options)
    {
        $uri = $this->getResourceUri($name) . '/' . static::$verbs['massDestroy'];

        $action = $this->getResourceAction($name, $controller, 'massDestroy', $options);

        return $this->router->delete($uri, $action);
    }
}
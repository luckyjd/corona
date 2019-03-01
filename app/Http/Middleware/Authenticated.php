<?php

namespace App\Http\Middleware;

use Closure;

/**
 * Class Authenticated
 * @package App\Http\Middleware
 */
class Authenticated
{
    /**
     * @var null
     */
    protected $_guard = null;

    /**
     * Authenticated constructor.
     */
    public function __construct()
    {
        $this->init();
    }

    /**
     *
     */
    public function init()
    {

    }

    /**
     * @return null
     */
    public function getGuard()
    {
        return $this->_guard;
    }

    /**
     * @param null $guard
     */
    public function setGuard($guard)
    {
        $this->_guard = $guard;
    }

    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  \Closure $next
     * @param  string|null $guard
     * @return mixed
     */
    public function handle($request, Closure $next, $guard = null)
    {
        if ($this->_isResetRoute($request) || $request->routeIs('*login')) {
            return $next($request);
        }

        if (!$this->getGuard()->check()) {
            return $this->_toLogin($request);
        }
        return $next($request);
    }

    /**
     * @param $request
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    protected function _toLogin($request)
    {
        return redirect($this->_getBackUrl($request));
    }

    /**
     * @param $request
     * @return string
     */
    protected function _getBackUrl($request)
    {
        $params = ['return_url' => buildDashBoardUrl()];
        $url = route('backend.login', $params);
        return $url;
    }

    protected function _isResetRoute($request)
    {
        if ($request->routeIs('*password.*')) {
            return true;
        }
        return false;
    }
}

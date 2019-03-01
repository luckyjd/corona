<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Auth\AuthenticationException;

class RedirectIfAuthenticated extends Authenticated
{
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
        $auth = frontendGuard();
        switch (true) {
            case isBackend():
                $auth = backendGuard();
                break;
            case isApi():
                $auth = apiGuard();
                break;
        }
        if (!$auth->check()) {
            if($request->expectsJson()){
                throw new AuthenticationException(trans('messages.permission_denied'));
            }
            return $this->_toLogin($request);
        }
        return $next($request);
    }

    /**
     * @param $request
     * @return string
     */
    protected function _getBackUrl($request)
    {
        if(!isBackend()){
            return route('home');
        }
        $params = ['return_url' => $request->fullUrl()];
        $url = route('login', $params);
        return $url;
    }
}

<?php

namespace App\Http\Middleware;

use Closure;

class FormCheckboxHandle
{
    public function handle($request, Closure $next)
    {
        // set default value if checkbox won't submit
        $checkbox = (array)$request->get(getConstant('CHECKBOX_PREFIX'), []);
        $checkboxMulti = (array)$request->get(getConstant('CHECKBOX_MULTI_PREFIX'), []);
        $this->_handle($checkbox, $request);
        $this->_handle($checkboxMulti, $request, true);

        return $next($request);
    }

    protected function _handle($keys, &$request, $multi = false)
    {
        if (empty($keys)) {
            return;
        }
        // set default value if checkbox won't submit
        $data = [];
        $params = $request->all();
        foreach ($keys as $key) {
            array_set($data, $key, array_get($params, $key, $multi ? [] : false));
            $request->merge($data);
        }
    }
}

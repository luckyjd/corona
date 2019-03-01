<?php

define('LARAVEL_START', microtime(true));

/*
|--------------------------------------------------------------------------
| Register The Composer Auto Loader
|--------------------------------------------------------------------------
|
| Composer provides a convenient, automatically generated class loader
| for our application. We just need to utilize it! We'll require it
| into the script here so that we do not have to worry about the
| loading of any our classes "manually". Feels great to relax.
|
*/

if (! function_exists('e')) {
    /**
     * Escape HTML special characters in a string.
     *
     * @param  \Illuminate\Contracts\Support\Htmlable|string  $value
     * @return string
     */
    function e($value)
    {
        if(strpos($value, 'trans-with-editor') !== false){
            return $value;
        }
        if ($value instanceof \Illuminate\Contracts\Support\Htmlable) {
            return $value->toHtml();
        }

        return htmlspecialchars($value, ENT_QUOTES, 'UTF-8', false);
    }
}
require __DIR__.'/../vendor/autoload.php';

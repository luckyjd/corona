<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        $this->app->bind('myrouter', 'App\Helpers\Router');

        $registrar = new \App\Helpers\ResourceRegistrar($this->app['router']);

        $this->app->bind('Illuminate\Routing\ResourceRegistrar', function () use ($registrar) {
            return $registrar;
        });

        $this->_logSql();
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        ////Facade to Object binding
        $this->app->bind('channellog', 'App\Helpers\ChannelWriter');
        $this->app->bind('mystorage', 'App\Helpers\MyStorage');
    }

    protected function _logSql()
    {
        // log sql
        if (!env('local') && !getSystemConfig('sql_log')) {
            return true;
        }

        \Illuminate\Support\Facades\DB::enableQueryLog();
        \Illuminate\Support\Facades\DB::listen(function ($sql) {
            try {
                if (\Illuminate\Support\Facades\App::runningInConsole() && strpos($sql->sql, 'jobs') !== false) {
                    return true;
                }
                $messages = ' Time: ' . $sql->time . ' SQL: ' . sql_binding($sql->sql, $sql->bindings);
                logDebug($messages);
            } catch (\Exception $e) {

            } catch (\Error $error) {

            }
        });
    }
}

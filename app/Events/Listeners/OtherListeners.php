<?php

namespace App\Events\Listeners;

use App\Events\Handles\Other\Repositories\MHotelPlanSyncStock;

/**
 * Class Listeners
 * @package App\Events
 */
class OtherListeners extends \App\Events\Listeners\Base\Listeners
{
    /**
     * Register any events for your application.
     *
     * @return void
     */
    public function boot()
    {
        $this->_listenOtherEvent('sync_stock.repositories.m_hotel_plan', function ($arg) {
            return (new MHotelPlanSyncStock())->handle($arg);
        });
    }
}
<?php

namespace App\Events\Listeners;
use App\Events\Handles\Controllers\Backend\CartSyncStock;
use App\Events\Handles\Controllers\Backend\CheckoutAfterStore;
use App\Events\Handles\Controllers\Backend\CheckoutSyncStock;
use App\Events\Handles\Controllers\Backend\OrderAfterCancel;

/**
 * Class Listeners
 * @package App\Events
 */
class ControllerListeners extends \App\Events\Listeners\Base\ControllerListeners
{
    /**
     * Register any events for your application.
     *
     * @return void
     */
    public function boot()
    {
        parent::boot();
        $this->_listenControllerEvent('sync_stock.backend.checkout', function ($arg) {
            return (new CheckoutSyncStock())->handle($arg);
        });

        $this->_listenControllerEvent('sync_stock.backend.cart', function ($arg) {
            return (new CartSyncStock())->handle($arg);
        });

        $this->_listenControllerEvent('after_store.backend.checkout', function ($arg) {
            return (new CheckoutAfterStore())->handle($arg);
        });

        $this->_listenControllerEvent('order_after_cancel.backend.order', function ($arg) {
            return (new OrderAfterCancel())->handle($arg);
        });

//        $this->_listenControllerEvent('after_render.frontend.home', function ($arg) {
//            return (new AfterRender())->handle($arg);
//        });
    }
}
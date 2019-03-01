<?php

namespace App\Model\Entities;

use Illuminate\Notifications\Notifiable;

class Shipping extends \App\Model\Base\Auth\User
{
    use Notifiable;
    use \App\Model\Presenters\Shipping;
    protected $_alias = 'shipping';
    protected $table = 'shipping';

    protected $fillable = [
        'application_id', 'first_name', 'last_name', 'email', 'zip_code', 'pref_id', 'address', 'address1', 'address2', 'address3', 'tel', 'store_list', 'shipping_flg'
    ];
}
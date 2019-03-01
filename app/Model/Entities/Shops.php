<?php

namespace App\Model\Entities;

use App\Model\Presenters\Shop;
use Illuminate\Notifications\Notifiable;

class Shops extends \App\Model\Base\Auth\User
{
    use Notifiable;
    use Shop;
    protected $_alias = 'shops';
    protected $table = 'shops';
}
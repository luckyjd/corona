<?php

namespace App\Model\Entities;

use App\Model\Base\ModelSoftDelete;

class Application extends ModelSoftDelete
{
    protected $table = 'applications';

    protected $urlAttributes = ['present_image'];
    use \App\Model\Presenters\Application;
    protected static $_destroyRelations = ['shipping'];

    public function user()
    {
        return $this->hasOne(User::class, 'id', 'user_id');
    }

    public function shipping()
    {
        return $this->hasOne(Shipping::class, 'application_id', 'id');
    }

    public function present()
    {
        return $this->hasOne(Present::class, 'id', 'present_id');
    }

    public function serialNumber()
    {
        return $this->hasOne(SerialNumber::class, 'id', 'serial_number_id');
    }
}

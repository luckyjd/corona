<?php

namespace App\Model\Entities;

use App\Model\Base\ModelSoftDelete;

class SerialNumber extends ModelSoftDelete
{
    protected $table = 'serial_numbers';
    protected $_alias = 'serial_numbers';
    use \App\Model\Presenters\SerialNumber;
}

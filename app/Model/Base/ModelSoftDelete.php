<?php

namespace App\Model\Base;
/**
 * Class Base
 * @package App\Model\Base
 */
class ModelSoftDelete extends Base
{
    use CustomSoftDeletes;
    protected $dates = [];
}

<?php

namespace App\Validators;

use App\Validators\Base\BaseValidator;

class SerialNumber extends BaseValidator
{
    protected function _getRulesDefault()
    {
        $rules = [
            'serial_number' => 'required|max:11',
            'key' => 'required|max:64',
            'salt' => 'required|max:256',
        ];

        return $rules;
    }
}
?>
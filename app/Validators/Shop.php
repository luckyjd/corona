<?php

namespace App\Validators;

use App\Validators\Base\BaseValidator;

/**
 * Class AdminUserInfo
 * @package App\Validator
 */
class Shop extends BaseValidator
{
    protected function _getRulesDefault()
    {
        $rules = [
            'address' => 'max:256',
        ];
        return $rules;
    }
    public function validateCsv($data)
    {
        $this->beforeValidateCreate($data);
        return $this->with($data)->passes(self::RULE_CREATE);
    }
}
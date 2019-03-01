<?php

namespace App\Validators;

use App\Validators\Base\BaseValidator;

/**
 * Class AdminUserInfo
 * @package App\Validator
 */
class Shipping extends BaseValidator
{
    protected function _getRulesDefault()
    {
        $rules = [
            'shipping_flg' => 'required',
            'zip_code' => 'required|numeric|min:9990|max:9999999999',
            'tel' => 'required|phone',
            'address' => 'required|max:256',
        ];
        return $rules;
    }
    public function validateCsv($data)
    {
        $this->beforeValidateCreate($data);
        return $this->with($data)->passes(self::RULE_CREATE);
    }
}
<?php

namespace App\Validators;

use App\Validators\Base\BaseValidator;

/**
 * Class AdminUserInfo
 * @package App\Validator
 */
class User extends BaseValidator
{
    protected function _getRulesDefault()
    {
        return parent::_getRulesDefault();
    }

    /**
     * @return array
     */
    protected function _buildCreateRules()
    {
        return [
            'rules' => $this->_buildRules([
                'password' => 'required|same:password_confirmation|min:6|max:8',
                //'password_confirmation' => 'required|same:password_confirmation|min:6|max:8',
            ])
        ];
    }

    protected function _buildUpdateRules()
    {
        return parent::_buildUpdateRules();
    }

    protected function _buildSearchRules()
    {
        return parent::_buildSearchRules();
    }

    protected function _buildDestroyRules()
    {
        return parent::_buildDestroyRules();
    }

    public function validateLogin($data)
    {
        $rules = array(
            'email' => 'required|email',
            'password' => 'required',
        );
        $messages = [
            'email.required' => trans('auth.id_required'),
            'email.email' => trans('auth.email_password_invalid'),
            'password.required' => trans('auth.password_required'),
        ];
        return $this->_addRules($rules, $messages)->with($data)->passes();
    }

    /**
     * @param $data
     * @return bool
     */
    public function validateCreate($data)
    {
        $rules = array(
            'email' => 'required|email|unique:users', // make sure the email is an actual email
            'password' => 'required',
            //'password_confirmation' => 'required|same:password_confirmation',
            'first_name' => 'required|max:64',
            'last_name' => 'required|max:64',
            //'address' => 'required',
            //'tel' => 'required|max:13',
            //'zip_code' => 'required|max:7',
            'pref_id' => 'required',
        );
        $messages = [
            'email.required' => trans('auth.id_required'),
            'email.email' => trans('auth.email_password_invalid'),
            'password.required' => trans('auth.password_required'),
        ];
        return $this->_addRules($rules, $messages)->with($data)->passes();
    }

    /**
     * @param $data
     * @return bool
     */
    public function validateResetPassword($data)
    {
        $rules = array(
            'email' => 'required|email|exists:users', // make sure the email is an actual email
        );
        return $this->_addRules($rules)->with($data)->passes();
    }

    /**
     * @param $data
     * @return bool
     */
    public function validateConfirmReset($data)
    {
        $rules = array(
            'password' => 'required|min:5|max:12|same:password_confirmation',
            'password_confirmation' => 'required',
        );
        $message = [];
        return $this->_addRules($rules, $message)->with($data)->passes();
    }

    public function validateUpdateAddressShip($data)
    {
        $rules = array(
            'first_name' => 'required',
            'last_name' => 'required',
            'email' => 'required|email' . $this->_getFieldUniqueRule('users', ['email'], getCurrentUserId()),
            'pref_id' => 'required',
            'zip_code' => 'required|size:7',
            'address' => 'required',
            'tel' => 'required|regex:/^\d{10,11}$/',
        );

        $messages = [

        ];

        return $this->_addRules($rules, $messages)->with($data)->passes();
    }
}
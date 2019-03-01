<?php

namespace App\Validators;

use App\Validators\Base\BaseValidator;

/**
 * Class AdminUserInfo
 * @package App\Validator
 */
class Present extends BaseValidator
{
    protected function _getRulesDefault()
    {
        $fileRule = getConfig('file.admin.avatar');
        $imageType = implode(',', $fileRule['ext']);

        $rules = [
            'name' => 'required|max:512',
            'quantity' => 'required|numeric',
            'type' => 'required'. $this->_getInArrayRule(getKeysConfig('presents.types')),
            'introduction' => 'required',
            'image' => 'required'
        ];

        if ($this->_hasFileUpload('image')) {
            $rules += [
                'image' => 'mimes:' . $imageType . '|max:' . $fileRule['size']['max'] * 1024,
            ];
        }

        return $rules;
    }

    protected function _buildCreateRules()
    {
        return parent::_buildCreateRules();
    }

    protected function _buildUpdateRules()
    {
        return [
            'rules' => $this->_buildRules([
                'remain_quantity' => 'required|numeric',
            ])
        ];
    }

    protected function _buildShowRules()
    {
        return parent::_buildShowRules();
    }

    protected function _buildDestroyRules()
    {
        return parent::_buildDestroyRules();
    }
}
?>
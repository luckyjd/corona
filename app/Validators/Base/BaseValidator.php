<?php

namespace App\Validators\Base;

use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Lang;
use \Prettus\Validator\LaravelValidator;

/**
 * Class BaseValidator
 * @package App\Validator\Base
 */
class BaseValidator extends LaravelValidator
{
    /**
     *
     */
    const RULE_CREATE = 'create';
    /**
     *
     */
    const RULE_UPDATE = 'update';
    /**
     *
     */
    const RULE_SHOW = 'show';
    /**
     *
     */
    const RULE_DESTROY = 'destroy';
    /**
     *
     */
    const RULE_SEARCH = 'search';

    /**
     *
     */
    const IMAGE_EXTENSION = 'img';

    /**
     *
     */
    const CSV_EXTENSION = 'csv';

    /**
     * @var null
     */
    protected $_model = null;
    /**
     * @var array
     */
    protected $rules = [];
    /**
     * @var array
     */
    protected $messages = [];
    /**
     * @var array
     */
    protected $_data = [];

    public function with(array $data)
    {
        $this->data = array_replace_recursive($this->data, $data, $this->_data);

        return $this;
    }

    /**
     * @param $data
     * @return bool
     */
    public function validateCreate($data)
    {
        $this->beforeValidateCreate($data);
        return $this->with($data)->passes(self::RULE_CREATE);
    }

    /**
     * @param $data
     * @return bool
     */
    public function validateUpdate($data)
    {
        $this->beforeValidateUpdate($data);
        return $this->with($data)->passes(self::RULE_UPDATE);
    }

    /**
     * @param $data
     * @return bool
     */
    public function validateShow($data)
    {
        $this->beforeValidateShow($data);
        return $this->with($data)->passes(self::RULE_SHOW);
    }

    /**
     * @param $data
     * @return bool
     */
    public function validateDestroy($data)
    {
        $this->beforeValidateDestroy($data);
        return $this->with($data)->passes(self::RULE_DESTROY);
    }

    /**
     * @param $data
     * @return bool
     */
    public function validateSearch($data)
    {
        $this->beforeValidateSearch($data);
        return $this->with($data)->passes(self::RULE_SEARCH);
    }

    /**
     * @param $data
     * @return bool
     */
    public function validateOther($data)
    {
        $rules = [
            'id' => 'required|max:1'
        ];
        $message = [];
        return $this->_addRules($rules, $message)->with($data)->passes();
    }

    /**
     * @param string $type
     * @param null $size
     * @param array $ext
     * @return string
     */
    public function _fileRule($type = self::IMAGE_EXTENSION, $size = null, $ext = array())
    {
        $size = 1024 * 1024 * (empty($size) ? getConfig('file.' . $type . '.size') : $size);
        $ext = empty($ext) ? implode(',', getConfig('file.' . $type . '.ext')) : implode(',', $ext);
        $rule = 'max:' . $size . '|mimes:' . $ext;

        return $rule;
    }

    /**
     * @return array
     */
    protected function _buildCreateRules()
    {
        return ['rules' => $this->_getRulesDefault(), 'messages' => $this->_getMessagesDefault()];
    }

    protected function _buildRulesWithPrimaryKey()
    {
        $rules = [];
        foreach ((array)$this->getModel()->getKeyName() as $key) {
            $rules[$key] = 'required';
        }
        if (isset($key)) {
            $rules[$key] .= $this->_getExistInDbRule($this->getModel()->getTableName());
        }
        return $rules;
    }

    protected function _getMessagePrimaryKeyExist()
    {
        $keys = (array)$this->getModel()->getKeyName();
        return [end($keys) . '.custom_exists' => trans('validation.custom_exists', ['attribute' => $this->getModel()->getModelName()])];
    }

    /**
     * @return array
     */
    protected function _buildUpdateRules()
    {
        return ['rules' => $this->_buildRulesWithPrimaryKey() + $this->_getRulesDefault(), 'messages' => $this->_getMessagesDefault()];
    }

    /**
     * @return array
     */
    protected function _buildShowRules()
    {
        return [
            'rules' => $this->_buildRules($this->_buildRulesWithPrimaryKey(), false),
            'messages' => $this->_getMessagePrimaryKeyExist(),
        ];
    }

    /**
     * @return array
     */
    protected function _buildDestroyRules()
    {
        return [
            'rules' => $this->_buildRules(
                $this->_buildRulesWithPrimaryKey(),
             false),
            'messages' => $this->_getMessagePrimaryKeyExist(),
        ];
    }

    /**
     * @return array
     */
    protected function _buildSearchRules()
    {
        return ['rules' => [], 'messages' => []];
    }

    /**
     * @param $data
     */
    public function beforeValidateCreate(&$data)
    {
        return $this->_build(self::RULE_CREATE, $data);
    }

    /**
     * @param $data
     */
    public function beforeValidateUpdate(&$data)
    {
        return $this->_build(self::RULE_UPDATE, $data);
    }

    protected function _getPrimaryKeyString()
    {
        $keys = (array)$this->getModel()->getKeyName();
        return implode('_', $keys);
    }

    /**
     * @param $data
     */
    public function beforeValidateShow(&$data)
    {
        if (!is_array($data)) {
            $data = array($this->_getPrimaryKeyString() => $data);
        }
        return $this->_build(self::RULE_SHOW, $data);
    }

    /**
     * @param $data
     */
    public function beforeValidateDestroy(&$data)
    {
        if (!is_array($data)) {
            $data = array($this->_getPrimaryKeyString() => $data);
        }
        return $this->_build(self::RULE_DESTROY, $data);
    }

    /**
     * @param $data
     */
    public function beforeValidateSearch(&$data)
    {
        return $this->_build(self::RULE_SEARCH, $data);
    }

    /**
     * @return array
     */
    protected function _getRulesDefault()
    {
        return array();
    }

    /**
     * @return array
     */
    protected function _getMessagesDefault()
    {
        return array();
    }

    /**
     * @param array $rules
     * @param bool $mergeDefault
     * @return array
     */
    protected function _buildRules($rules = array(), $mergeDefault = true)
    {
        return $mergeDefault ? array_merge($this->_getRulesDefault(), $rules) : $rules;
    }

    /**
     * @param array $messages
     * @param bool $mergerDefault
     */
    protected function _setMessages($messages = array(), $mergerDefault = true)
    {
        $messagesX = $this->messages;
        if ($mergerDefault) {
            $messagesX = array_merge($this->messages, $this->_getMessagesDefault());
        }
        $this->messages = array_merge($messagesX, $messages);
    }

    /**
     * @param null $action
     * @return bool
     */
    public function passes($action = null)
    {
        $this->setData($this->data);
        $rules = $action ? $this->getRules($action) : $this->rules;
        $validator = $this->validator->make($this->data, $rules, $this->messages)->setAttributeNames($this->_getAttributeNames());

        if ($validator->fails()) {
            $this->errors = $validator->messages();
            return false;
        }

        return true;
    }

    protected function _getAttributeNames()
    {
        return (array)Lang::get('models.' . $this->getModel()->getAlias() . '.attributes');
    }

    /**
     * @return null
     */
    public function getModel()
    {
        return $this->_model;
    }

    /**
     * @param null $model
     * @return  $this;
     */
    public function setModel($model)
    {
        $this->_model = $model;
        return $this;
    }

    /**
     * @param $type
     */
    protected function _build($type, $data = [])
    {
        $this->setData($data);
        $r = array();
        switch ($type) {
            case self::RULE_CREATE :
                $r = $this->_buildCreateRules();
                break;
            case self::RULE_UPDATE :
                $r = $this->_buildUpdateRules();
                break;
            case self::RULE_SHOW :
                $r = $this->_buildShowRules();
                break;
            case self::RULE_DESTROY :
                $r = $this->_buildDestroyRules();
                break;
            case self::RULE_SEARCH:
                $r = $this->_buildSearchRules();
                break;
        }
        $this->rules[$type] = isset($r['rules']) ? (array)$r['rules'] : array();
        $this->_setMessages(isset($r['messages']) ? (array)$r['messages'] : array());
    }

    /**
     * @param string $tableName
     * @param array $fields
     * @return string
     */
    protected function _getExistInDbRule($tableName = '', $fields = array())
    {
        if (empty($fields)) {
            $fields = (array)$this->getModel()->getKeyName();
        }
        $tableName = $tableName ? $tableName : $this->getModel()->getTableName();
        $fieldStr = '';
        foreach ($fields as $fieldName) {
            $fieldStr .= ',' . $fieldName;
        }
        return '|custom_exists:' . $tableName. $fieldStr;
    }

    protected function _implode($prefix, $params)
    {
        return join($prefix, array_map(function ($value) {
            return $value === null ? 'NULL' : $value;
        }, $params));
    }

    /**
     * @param string $tableName
     * @param array $fields
     * @return string
     */
    protected function _getUniqueInDbRule($tableName = '', $fields = array())
    {
        $tableName = $tableName ? $tableName : $this->getModel()->getTableName();
        $fieldStr = '';
        foreach ($fields as $fieldName) {
            $fieldStr .= ',' . $fieldName . ',' . array_get($this->_data, $fieldName);
        }
        return '|custom_unique:' . $tableName . $fieldStr;
    }

    protected function _getFieldUniqueRule($tableName = '', $fields = array(), $id = null)
    {
        $tableName = $tableName ? $tableName : $this->getModel()->getTableName();
        $fieldStr = '';
        foreach ($fields as $fieldName) {
            $fieldStr .= ',' . $fieldName . (array_get($this->_data, $fieldName) ? (',' . array_get($this->_data, $fieldName)) : '');
        }
        return '|field_unique:' . $tableName . $fieldStr . ',' . $id;
    }

    /**
     * @param $array
     * @return string
     */
    protected function _getInArrayRule($array)
    {
        return '|in:' . $this->_implode(',', $array);
    }

    /**
     * @return string
     */
    protected function _getSmallIntegerRule()
    {
        return '|integer|max:32767';
    }

    protected function _addDeleteScope($fields = [])
    {
        if ($field = getDelFlagColumn()) {
            $fields[] = $field;
            $fields[] = getDelFlagColumn('active');
            return $fields;
        }
        if ($field = getDeletedAtColumn()) {
            $fields[] = $field;
            $fields[] = null;
            return $fields;
        }
    }

    /**
     * @param $key
     * @param $default
     * @return array
     */
    public function getData($key = null, $default = null)
    {
        if ($key) {
            return array_get($this->_data, $key, $default);
        }
        return $this->_data;

    }

    /**
     * @param array $data
     */
    public function setData($data)
    {
        $this->_data = array_replace_recursive($this->_data, $data);
    }

    /**
     * @param $key
     * @return bool
     */
    public function has($key)
    {
        $data = $this->getData();
        return isset($data[$key]);
    }

    /**
     * @param array $rules
     * @param array $messages
     * @return $this
     */
    protected function _addRules($rules = array(), $messages = array())
    {
        $this->rules += $rules;
        $this->_setMessages($messages);
        return $this;
    }

    protected $_otherData = [];

    /**
     * @return array
     */
    public function getOtherData($key = null, $default = null)
    {
        if ($key) {
            return isset($this->_otherData[$key]) ? $this->_otherData[$key] : $default;
        }
        return $this->_otherData;

    }

    /**
     * @param array $otherData
     * @return $this;
     */
    public function setOtherData($otherData)
    {
        $this->_otherData += $otherData;
        return $this;
    }

    protected function _hasFileUpload($field)
    {
        if ($this->getData($field) instanceof UploadedFile) {
            return true;
        }

        return false;
    }

    protected function _toMb($value)
    {
        return $value * 1024;
    }
}
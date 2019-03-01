<?php namespace App\Validators\Base;

use App\Model\Base\Base;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\Validator;

/**
 * Class CustomValidator
 * @package App\Validator
 */
class CustomValidator extends Validator
{
    /**
     * @var array
     */
    private $_customMessages = [
        'greater_than' => 'The :attribute format is invalid !',
        'greater_than_equal' => 'The :attribute format is invalid !',
        'greater_than_equal_for_time_stamp' => 'The :attribute format is invalid !',
    ];

    /**
     * CustomValidator constructor.
     * @param \Illuminate\Contracts\Translation\Translator $translator
     * @param array $data
     * @param array $rules
     * @param array $messages
     * @param array $customAttributes
     */
    public function __construct($translator, $data, $rules,
                                $messages = array(), $customAttributes = array())
    {
        parent::__construct($translator, $data, $rules, $messages, $customAttributes);
        $this->_setCustomMessages();
    }

    /**
     * Setup custom error messages
     */
    protected function _setCustomMessages()
    {
        $this->setCustomMessages($this->_customMessages);
    }

    /**
     * Custom validator method
     */
    public function validateGreaterThan($attribute, $value, $parameters)
    {
        $data = $this->getData();
        $other = $data[$parameters[0]];
        return isset($other) and intval($value) > intval($other);
    }

    /**
     * Custom validator method
     */
    public function validateGreaterThanField($attribute, $value, $parameters, $validator)
    {
        $min_field = $parameters[0];
        $data = $validator->getData();
        $min_value = Arr::get($data, $min_field);
        return $value > $min_value;
    }

    /**
     * Custom validator method
     */
    public function validateGreaterThanOrEqualField($attribute, $value, $parameters, $validator)
    {
        $min_field = $parameters[0];
        $data = $validator->getData();
        $min_value = Arr::get($data, $min_field);
        return $value >= $min_value;
    }

    /**
     * Custom validator method
     */
    public function validateGreaterThanOrEqualTimeField($attribute, $value, $parameters, $validator)
    {
        $min_field = $parameters[0];
        $data = $validator->getData();
        $min_value = Arr::get($data, $min_field);
        strlen($value) == 4 ? $value = '0' . $value : null;
        strlen($min_value) == 4 ? $min_value = '0' . $min_value : null;
        return $value >= $min_value;
    }

    /**
     * Custom validator method
     */
    public function validateLessThanField($attribute, $value, $parameters, $validator)
    {
        $min_field = $parameters[0];
        $data = $validator->getData();
        $min_value = Arr::get($data, $min_field);
        return $value < $min_value;
    }

    /**
     * Custom validator method
     */
    public function validateLessOrEqualThanField($attribute, $value, $parameters, $validator)
    {
        $min_field = $parameters[0];
        $data = $validator->getData();
        $min_value = Arr::get($data, $min_field);
        return $value <= $min_value;
    }

    /**
     * @param $attribute
     * @param $value
     * @param $parameters
     * @return bool
     */
    public function validateGreaterThanEqual($attribute, $value, $parameters)
    {
        $data = $this->getData();
        $other = $data[$parameters[0]];
        if (intval($value) == intval($other)) {
            return true;
        }
        return isset($other) and intval($value) > intval($other);
    }

    /**
     * @param $attribute
     * @param $value
     * @param $parameters
     * @return bool
     */
    public function validateGreaterThanEqualForTimeStamp($attribute, $value, $parameters)
    {
        $value = date('Y-m-d H:i:s', strtotime($value));
        $other = date('Y-m-d H:i:s', strtotime($parameters[0]));

        if ($value == $other) {
            return true;
        }
        return $value > $other;
    }

    protected function replaceGreaterThanField($message, $attribute, $rule, $parameters)
    {
        return str_replace(':other', $this->getDisplayableAttribute($parameters[0]), $message);
    }

    protected function replaceGreaterThanOrEqualField($message, $attribute, $rule, $parameters)
    {
        return str_replace(':other', $this->getDisplayableAttribute($parameters[0]), $message);
    }

    protected function replaceGreaterThanOrEqualTimeField($message, $attribute, $rule, $parameters)
    {
        return str_replace(':other', $this->getDisplayableAttribute($parameters[0]), $message);
    }

    protected function replaceGreaterThanOrEqual($message, $attribute, $rule, $parameters)
    {
        return str_replace(':other', $this->getDisplayableAttribute($parameters[0]), $message);
    }

    protected function replaceGreaterThanEqualForTimeStamp($message, $attribute, $rule, $parameters)
    {
        return str_replace(':other', $this->getDisplayableAttribute($parameters[0]), $message);
    }

    /**
     * @param $attribute
     * @param $value
     * @param $parameters
     * @return bool
     */
    public function validateKatakana($attribute, $value, $parameters)
    {
        $result = preg_match('/^([゠ァアィイゥウェエォオカガキギクグケゲコゴサザシジスズセゼソゾタダチヂッツヅテデトドナニヌネノハバパヒビピフブプヘベペホボポマミムメモャヤュユョヨラリルレロヮワヰヱヲンヴヵヶヷヸヹヺ・ーヽヾヿ]+)$/u', $value, $matches);
        return $result ? true : false;
    }

    /*
     * Validate that an attribute matches a date format.
     *
     * @param  string $attribute
     * @param  mixed $value
     * @param  array $parameters
     * @return bool
     */
    public function validateDateFormat($attribute, $value, $parameters)
    {
        $date = ['Y-m-d H:i:s' => getConstant('DEFAULT_DATE_TIME_VALUE'), 'Y-m-d' => getConstant('DEFAULT_DATE_VALUE'), 'H:i:s' => getConstant('DEFAULT_TIME_VALUE')];
        $vFormat = isset($parameters[0]) ? $parameters[0] : '';
        if (!$vFormat) {
            return parent::validateDateFormat($attribute, $value, $parameters);
        }
        foreach ($date as $format => $item) {
            if ($format === $vFormat && $item === $value) {
                return true;
            }
        }
        return parent::validateDateFormat($attribute, $value, $parameters);
    }

    /**
     * @param $attribute
     * @param $value
     * @return bool
     */
    public function validateArrayRequired($attribute, $value)
    {
        if (!is_array($value) && empty($value) && '0' !== (string)$value) {
            return false;
        }
        if (is_array($value)) {
            $value = array_filter($value);
            if (empty($value)) {
                return false;
            }
            foreach ($value as $item) {
                if (!$this->validateArrayRequired($attribute, $item)) {
                    return false;
                }
            }
        }
        return true;
    }

    /**
     * @param $attribute
     * @param $value
     * @param $parameters
     * @return bool
     */
    public function validatePhone($attribute, $value, $parameters)
    {
        $regex = "/^\d{9,11}$/";
        if (strpos($value, '+') !== false) {
            $regex = "/^\+?(?:[0-9] ?){9,11}[0-9]$/";
        }
        return preg_match($regex, $value);
    }

    /**
     * @param $attribute
     * @param $values
     * @param $parameters
     * @return bool
     */
    public function validateRequiredOne($attribute, $values, $parameters)
    {
        if (empty($parameters) || !is_array($parameters)) {
            return false;
        }
        $field = array_shift($parameters);
        foreach ($values as $index => $item) {
            if (isset($item[$field]) && !empty($item[$field])) {
                return true;
            }
            if (is_array($item)) {
                foreach ($item as $idx => $child) {
                    if (isset($child[$field]) && !empty($child[$field])) {
                        return true;
                    }
                }
            }
        }

        return false;
    }

    /**
     * @param $attribute
     * @param $values
     * @param $parameters
     * @return bool
     */
    public function validateCustomExists($attribute, $values, $parameters)
    {
        if (empty($parameters[0]) || !is_array($parameters)) {
            return false;
        }
        $model = getModelFromTable($parameters[0]);
        $query = $model->getQuery();
        unset($parameters[0]);
        $parameters = array_values($parameters);
        if (empty($parameters)) {
            $parameters = (array)$model->getKeyName();
        }
        foreach ($parameters as $parameter) {
            $query->where($parameter, array_get($this->data, $parameter));
        }
        if (!$model->isForceDeleting()) {
            $query->where(function ($q) {
                return $q->where(getDelFlagColumn(), '=', getDelFlagColumn('active'))->orWhereNull(
                    getDelFlagColumn()
                );
            });
        }
        return $query->count() >= 1;
    }

    /**
     * @param $attribute
     * @param $values
     * @param $parameters
     * @return bool
     */
    public function validateCustomUnique($attribute, $values, $parameters)
    {
        if (empty($parameters[0]) || !is_array($parameters)) {
            return false;
        }
        $model = getModelFromTable($parameters[0]);
        $query = $model->getQuery();
        unset($parameters[0]);
        $parameters = array_values($parameters);
        if (empty($parameters)) {
            $parameters = [$attribute];
        }
        $keys = (array)$model->getKeyName();
        $keysData = [];
        foreach ($keys as $key) {
            if (array_key_exists($key, $this->data)) {
                $keysData[$key] = $this->data[$key];
            }
        }
        if (!empty($keysData)) {
            foreach ($keysData as $key => $value) {
                $query->whereNotIn($key, (array)$value);
            }
        }

        foreach ($parameters as $parameter) {
            $query->where($parameter, array_get($this->data, $parameter));
        }
        if (!$model->isForceDeleting()) {
            $query->where(function ($q) {
                return $q->where(getDelFlagColumn(), '=', getDelFlagColumn('active'))->orWhereNull(
                    getDelFlagColumn()
                );
            });
        }
        return $query->count() <= 0;
    }

    public function validateFieldUnique($attribute, $values, $parameters)
    {
        if (empty($parameters[0]) || !is_array($parameters)) {
            return false;
        }
        $model = getModelFromTable($parameters[0]);
        $query = $model->getQuery();
        unset($parameters[0]);
        $parameters = array_values($parameters);
        if (empty($parameters)) {
            $parameters = [$attribute];
        }
        if (isset($parameters[1]) && $parameters[1]) {
            $query->where($model->getKeyName(), '<>', $parameters[1]);
            unset($parameters[1]);
        }

        foreach ($parameters as $parameter) {
            $query->where($parameter, array_get($this->data, $parameter));
        }
        if (!$model->isForceDeleting()) {
            $query->where(function ($q) {
                return $q->where(getDelFlagColumn(), '=', getDelFlagColumn('active'))->orWhereNull(
                    getDelFlagColumn()
                );
            });
        }
        return $query->count() <= 0;
    }
}
<?php

namespace App\Repositories\Base;

use App\Events\BaseEvent;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Input;
use Prettus\Repository\Eloquent\BaseRepository;
use Illuminate\Container\Container as Application;

/**
 * Class CustomRepository
 * @package App\Repositories\Base
 */
abstract class CustomRepository extends BaseRepository
{
    use BaseEvent;
    protected $_isBackend = true;
    protected $_delRelations = [];
    /**
     * @var array
     */
    protected $_queryParams = [];
    /**
     * @var string
     */
    protected $_sortField;
    /**
     * @var string
     */
    protected $_sortType = 'DESC';

    protected $_oldBuilder = null;

    /**
     * @return array
     */
    public function getDelRelations()
    {
        return $this->_delRelations;
    }

    /**
     * @param array $delRelations
     */
    public function setDelRelations($delRelations)
    {
        $this->_delRelations = array_merge($this->_delRelations, $delRelations);
    }


    /**
     * @return bool
     */
    public function isBackend()
    {
        return $this->_isBackend;
    }

    /**
     * @param bool $isBackend
     */
    public function setIsBackend($isBackend)
    {
        $this->_isBackend = $isBackend;
    }


    /**
     * @return array
     */
    public function getQueryParams()
    {
        return $this->_queryParams;
    }

    /**
     * @param array $queryParams
     */
    public function setQueryParams($queryParams)
    {
        $this->_queryParams = $queryParams;
    }

    /**
     * CustomRepository constructor.
     * @param Application $app
     */
    public function __construct(Application $app)
    {
        parent::__construct($app);
        $this->setQueryParams(Input::all());
        $sortField = $this->getSortField() ? $this->getSortField() : $this->getKeyName(true);
        $this->setSortField($this->getTableName() . '.' . $sortField);
        $this->setBuilder($this);
        $this->_oldBuilder = $this;
        $this->validator ? $this->validator = $this->getValidator()->setModel($this) : null;
        $this->setEventPrefix(getConstant('EVENT_OTHER_TYPE', 'other'));
        $className = get_class($this);
        $className = explode('\\', $className);
        $className = str_replace('Repository', '', end($className));
        $this->setEventSuffix('repositories.' . toUnderScore($className));
    }

    public function getEventName($name)
    {
        return getEventName(getConstant('EVENT_OTHER_TYPE') . '.' . $name);
    }

    /**
     * @var int
     */
    protected $_limit = 20;

    /**
     * @return string
     */
    public function getSortField()
    {
        return $this->_sortField;
    }

    /**
     * @param string $sortField
     * @return $this
     */
    public function setSortField($sortField)
    {
        $sortField = explode(':', $sortField);
        $sortField = isset($sortField[1]) ? $sortField[0] . '.' . $sortField[1] : $sortField[0];
        $sortField = str_replace('[', '.', str_replace(']', '', $sortField));
        $this->_sortField = $sortField;
        return $this;
    }

    /**
     * @return string
     */
    public function getSortType()
    {
        return $this->_sortType;
    }

    /**
     * @param string $sortType
     * @return $this
     */
    public function setSortType($sortType)
    {
        if (in_array(strtoupper($sortType), array('DESC', 'ASC'))) {
            $this->_sortType = $sortType;
        }
        return $this;

    }
    /**
     * @return int
     */
    public function getLimit()
    {
        return $this->_limit;
    }

    /**
     * @param int $limit
     * @return $this
     */
    public function setLimit($limit)
    {
        $this->_limit = $limit;
        return $this;
    }

    /**
     * @var null
     */
    protected $_builder = null;

    /**
     *
     */
    const OPERATORS = array(
        'gt' => '_greaterThan', 'gteq' => '_greaterThanOrEqual', 'lt' => '_lessThan', 'lteq' => '_lessThanOrEqual',
        'eq' => '_equal', 'neq' => '_notEqual', 'in' => '_in', 'nin' => '_notIn', 'consf' => '_containsFirst', 'consl' => '_containsLast',
        'cons' => '_contains', 'lteqt' => '_lessThanOrEqualWithTime', 'gteqt' => '_greaterThanOrEqualWithTime', 'isnull' => '_isNull', 'notnull' => '_notNull'
    );

    /**
     * @return null
     */
    public function getBuilder()
    {
        return $this->_builder;
    }

    /**
     * @param null $builder
     */
    public function setBuilder($builder)
    {
        $this->_builder = $builder;
    }


    /**
     * @return \Illuminate\Database\Eloquent\Model
     */
    public function getModel()
    {
        return $this->model;
    }

    /**
     * @param $model
     * @return $this
     */
    public function setModel($model)
    {
        $this->model = $model;
        return $this;
    }

    /**
     * Specify Model class name
     *
     * @return string
     */
    function model()
    {
        return "";
    }

    /**
     * @return mixed
     */
    public function getValidator()
    {
        return $this->validator;
    }

    /**
     * @param $name
     * @param $arguments
     * @return mixed
     */
    public function __call($name, $arguments)
    {
        return call_user_func_array(array($this->getModel(), $name), $arguments);
    }

    /**
     * @param $data
     * @param bool $forUpdate
     * @return mixed
     */
    public function findFirstOrNew($data, $forUpdate = false)
    {
        $keys = (array)$this->getKeyName();
        $keyValues = [];
        foreach ($keys as $key) {
            $keyValues[$key] = isset($data[$key]) ? $data[$key] : 0;
        }
        if (empty(array_filter($keyValues))) {
            $entity = clone $this->setRawAttributes($data);
            return $this->_prepareRelation($entity, $data, $forUpdate);
        }
        $entity = $this->withKeys($keyValues)->first();
        if (empty($entity)) {
            $entity = clone $this->setRawAttributes($data);
            return $this->_prepareRelation($entity, $data, $forUpdate);
        }
        return $this->_prepareRelation($entity->mergeAttributes($data), $data, $forUpdate);
    }

    /**
     * @param $query
     * @return CustomRepository|null
     */
    public function getListForExport($query)
    {
        $limit = isset($query['limit']) ? (int)$query['limit'] : backendPaginate('per_page.export_csv');
        return $this->search($query)->paginate($limit);
    }

    /**
     * @param $entity
     * @param $data
     * @param bool $forUpdate
     * @return mixed
     */
    protected function _prepareRelation($entity, $data, $forUpdate = false)
    {
        try {
            if (!isMulti($data)) {
                return $entity;
            }
            foreach ($data as $key => $item) {
                if (!is_array($item)) {
                    continue;
                }
                try {
                    $key = toCameCase($key);
                    $foreignKey = $entity->$key()->getForeignKeyName();
                } catch (\Exception $e) {
                    continue;
                } catch (\Error $error) {
                    continue;
                }
                $collect = collect();

                if ($entity->$key() instanceof \Awobaz\Compoships\Database\Eloquent\Relations\HasOne) {
                    $entity->removeAttribute($key);
                    $tmpItem = $item;
                    $item = $entity->$key()->getRelated()->mergeAttributes($item);
                    $item = $this->_prepareRelation($item, $tmpItem, $forUpdate);
                    $entity->setRelation($key, $item);
                    continue;
                }
                foreach ($item as $keyName => $value) {
                    $tmpValue1 = array_filter_null((array)$value);
                    if (($forUpdate && empty($tmpValue1)) || !is_array($value)) {
                        continue;
                    }
                    $value['p_keys'] = $keyName;
                    foreach ((array)$foreignKey as $fk) {
                        $value[$fk] = $entity->$fk;
                    }
                    // for multi primary key
                    foreach ($value as $k => $v) {
                        if (strpos($k, 'k_k') === false) {
                            continue;
                        }
                        $k = explode('k_k', $k);
                        $v = explode('k_k', $v);
                        foreach ($k as $idx => $x) {
                            $value[$x] = array_get($v, $idx);
                        }
                    }
                    $tmpValue = $value;
                    $value = $entity->$key()->getRelated()->mergeAttributes($value);
                    $value->setOriginKeyFromString($keyName);
                    $value = $this->_prepareRelation($value, $tmpValue, $forUpdate);
                    $collect->push($value);
                }
                $entity->removeAttribute($key);
                $entity->setRelation($key, $collect);
            }
        } catch (\Exception $e) {
            logError($e);
        }
        return $entity;
    }

    /**
     * @param $query
     * @return mixed
     */
    protected function _getPerPage($query)
    {
        switch (getCurrentArea()) {
            case 'backend':
                return array_get($query, 'per_page', backendPaginate('per_page.' . $this->getModel()->getTable(), backendPaginate('per_page.default', 20)));
                break;
            case 'api':
                return array_get($query, 'per_page', apiPaginate('per_page.' . $this->getModel()->getTable(), apiPaginate('per_page.default', 20)));
                break;
        }
        return array_get($query, 'per_page', frontendPaginate('per_page.' . $this->getModel()->getTable(), frontendPaginate('per_page.default', 20)));
    }

    /**
     * @param $query
     * @return CustomRepository|null
     */
    public function getListForBackend($query)
    {
        return $this->search($query)->paginate(backendPaginate('per_page.' . $this->getModel()->getTable(), backendPaginate('per_page.default', 20)));
    }

    /**
     * @param $query
     * @param int $page
     * @return mixed
     */
    public function getListForAjax($query, $page = 1)
    {
        return $this->search($query)->paginate($this->_getPerPage($query), ['*'], 'page', $page);
    }

    /**
     * @param $query
     * @return CustomRepository|null
     */
    public function getListForFrontend($query)
    {
        return $this->search($query)->paginate(frontendPaginate('per_page.' . $this->getModel()->getTable(), 20, frontendPaginate('per_page.default', 20)));
    }

    /**
     * @param $query
     * @return CustomRepository|null
     */
    public function getListForApi($query)
    {
        return $this->search($query)->paginate(apiPaginate('per_page.' . $this->getModel()->getTable(), apiPaginate('per_page.default', 20)));
    }

    /**
     * @param $query
     * @return CustomRepository|null
     */
    public function getListForRelation($query)
    {
        return $this->search($query)->paginate();
    }

    /**
     * @param $query
     * @return CustomRepository|null
     */
    public function getList($query = [])
    {
        return $this->search($query)->paginate();
    }

    /**
     * @param $id
     * @return mixed
     */
    public function findWithRelation($id)
    {
        $query = $this->withId($id);
        return $this->_withRelations($query)->first();
    }

    /**
     * @param $id
     * @return mixed
     */
    public function findForDestroy($id)
    {
        return $this->withId($id)->first();
    }

    /**
     * @param $query
     * @return mixed
     */
    protected function _withRelations($query)
    {
        return $query;
    }

    protected function _resetBuilder()
    {
        $this->setBuilder($this->_oldBuilder);
    }

    /**
     * @param array $query
     * @param array $columns
     * @return $this|null
     */
    public function search($query = array(), $columns = [])
    {
        $this->_resetBuilder();
        $this->setQueryParams($query);
        if (empty($query)) {
            return $this->select($this->_buildColumn($columns))->orderBy($this->getSortField(), $this->getSortType());
        }
        // set sort
        isset($query['sort_type']) ? $this->setSortType($query['sort_type']) : null;
        isset($query['sort_field']) ? $this->setSortField($query['sort_field']) : null;
        // build sql
        foreach ($query as $key => $value) {
            if (is_array($value)) {
                $this->_needWhereInOrNotIn($key, $value) ? $this->_buildInOrNotInConditions($key, $value) : $this->_buildConditions($key, $value);
                continue;
            }

            if (trim($value) !== '') {
                $this->_buildConditions($key, $value);
            }
        }
        return $this->getBuilder()->select($this->_buildColumn($columns))->orderBy($this->getSortField(), $this->getSortType());
    }

    protected function _needWhereInOrNotIn($fieldName, $value)
    {
        if (is_multi_array($value)) {
            return true;
        }
        return strpos($fieldName, '_in') !== false || strpos($fieldName, '_nin') !== false;
    }

    /**
     * @param $fieldName
     * @param $value
     * @return bool
     */
    protected function _buildInOrNotInConditions($fieldName, $value)
    {
        $table = '';
        if (is_multi_array($value)) {
            $table = $fieldName;
            foreach ($value as $field => $v) {
                if (!$this->_needWhereInOrNotIn($field, $v)) {
                    continue;
                }
                $this->_mapCondition($field, $v, $table);
            }
            return true;
        }
        $this->_mapCondition($fieldName, $value, $table);
    }

    /**
     * @param $fieldName
     * @param $value
     * @param string $table
     * @return bool
     */
    protected function _buildConditions($fieldName, $value, $table = '')
    {
        if (!is_array($value) && trim($value) !== '') {
            return $this->_mapCondition($fieldName, $value, $table);
        }
        if (empty($value)) {
            return false;
        }
        foreach ($value as $field => $val) {
            $this->_buildConditions($field, $val, $fieldName);
        }
    }

    protected function _mapCondition($fieldName, $value, $table)
    {
        $item = explode('_', $fieldName);
        if (count($item) < 2) {
            return false;
        }
        $operator = end($item);
        array_pop($item);
        $item = implode('_', $item);
        $field = $table ? $table . '.' . $item : $item;
        array_key_exists($operator, self::OPERATORS) ? $this->{self::OPERATORS[$operator]}($field, $value) : null;
        return true;
    }

    /**
     * @param $columns
     * @return array
     */
    protected function _buildColumn($columns)
    {
        $tableName = $this->getTableName();
        empty($columns) ? $columns = [$tableName . '.*'] : null;
        foreach ($columns as &$column) {
            $column = strpos($column, '.') === false ? $tableName . '.' . $column : $column;
        }
        return $columns;
    }

    /**
     * @param $field
     * @param $value
     * @return $this
     */
    protected function _equal($field, $value)
    {
        $this->setBuilder($this->getBuilder()->where($field, $value));
        return $this;
    }

    /**
     * @param $field
     * @param $value
     * @return $this
     */
    protected function _notEqual($field, $value)
    {
        $this->setBuilder($this->getBuilder()->where($field, '!=', $value));
        return $this;
    }

    /**
     * @param $field
     * @param $value
     * @return $this
     */
    protected function _greaterThan($field, $value)
    {
        $this->setBuilder($this->getBuilder()->where($field, '>', $value . '%'));
        return $this;
    }

    /**
     * @param $field
     * @param $value
     * @return $this
     */
    protected function _greaterThanOrEqual($field, $value)
    {
        $this->setBuilder($this->getBuilder()->where($field, '>=', $value));
        return $this;
    }

    /**
     * @param $field
     * @param $value
     * @return $this
     */
    protected function _greaterThanOrEqualWithTime($field, $value)
    {
        $value .= ' 00:00:00';
        $this->setBuilder($this->getBuilder()->where($field, '>=', $value));
        return $this;
    }

    /**
     * @param $field
     * @param $value
     * @return $this
     */
    protected function _lessThan($field, $value)
    {
        $this->setBuilder($this->getBuilder()->where($field, '<', $value));
        return $this;
    }

    /**
     * @param $field
     * @param $value
     * @return $this
     */
    protected function _lessThanOrEqual($field, $value)
    {
        $this->setBuilder($this->getBuilder()->where($field, '<=', $value));
        return $this;
    }

    /**
     * @param $field
     * @param $value
     * @return $this
     */
    protected function _lessThanOrEqualWithTime($field, $value)
    {
        $value .= ' 23:59:59';
        $this->setBuilder($this->getBuilder()->where($field, '<=', $value));
        return $this;
    }

    /**
     * @param $field
     * @param $value
     * @return $this
     */
    protected function _in($field, $value)
    {
        $this->setBuilder($this->getBuilder()->whereIn($field, (array)$value));
        return $this;
    }

    /**
     * @param $field
     * @param $value
     * @return $this
     */
    protected function _notIn($field, $value)
    {
        $this->setBuilder($this->getBuilder()->whereNotIn($field, (array)$value));
        return $this;
    }

    /**
     * @param $field
     * @param $value
     * @return $this
     */
    protected function _contains($field, $value)
    {
        $this->setBuilder($this->getBuilder()->where($field, 'LIKE', '%' . $value . '%'));
        return $this;
    }

    /**
     * @param $field
     * @param $value
     * @return $this
     */
    protected function _containsFirst($field, $value)
    {
        $this->setBuilder($this->getBuilder()->where($field, 'LIKE', '%' . $value));
        return $this;
    }

    /**
     * @param $field
     * @param $value
     * @return $this
     */
    protected function _containsLast($field, $value)
    {
        $this->setBuilder($this->getBuilder()->where($field, 'LIKE', $value . '%'));
        return $this;
    }

    /**
     * @param $field
     * @param $value
     * @return $this
     */
    protected function _isNull($field, $value)
    {
        $this->setBuilder($this->getBuilder()->whereNull($field));
        return $this;
    }

    /**
     * @param $field
     * @param $value
     * @return $this
     */
    protected function _notNull($field, $value)
    {
        $this->setBuilder($this->getBuilder()->whereNotNull($field));
        return $this;
    }

    /**
     * @param $key
     * @return bool
     */
    public function hasParam($key)
    {
        return Arr::has($this->_queryParams, $key);
    }

    /**
     * @param $key
     * @return bool
     */
    public function notEmpty($key)
    {
        return Arr::get($this->_queryParams, $key, false);
    }

    /**
     * @param $field
     * @return bool
     */
    public function hasSortField($field)
    {
        if ($this->getSortField() == $field) {
            return true;
        }
        return $this->_getKey($this->getSortField(), '.');
    }

    /**
     * @param $key
     * @param string $prefix
     * @return bool
     */
    protected function _getKey($key, $prefix = ':')
    {
        $keys = explode($prefix, $key);
        return count($keys) > 1 ? $keys[1] == $key : $keys[0] == $key;
    }
}
<?php

namespace App\Model\Scopes\Base;

/**
 * Trait Base
 * @package App\Model\Scopes\Base
 */
Trait Base
{
    /**
     * @param $query
     * @return mixed
     */
    public function scopeWithTrashed($query)
    {
        return $query->withTrashed();
    }

    /**
     * @param $query
     * @param string $type
     * @return mixed
     */
    public function scopeSortById($query, $type = 'ASC')
    {
        return $this->sortById($query, $type);
    }

    /**
     * @return mixed
     */
    public function scopeSortByIdDesc($query)
    {
        return $this->sortById($query, 'desc');
    }

    // supporter

    /**
     * @param $query
     * @param string $type
     * @return mixed
     */
    public function sortById($query, $type = 'ASC')
    {
        return $query->orderBy($this->getKeyName(true), $type);
    }

    /**
     * @param $query
     * @param $status
     * @return mixed
     */
    public function scopeWithStatus($query, $status)
    {
        return $query->where($this->getField('status'), $status);
    }

    /**
     * @param $query
     * @param $id
     * @return mixed
     */
    public function scopeWithId($query, $id)
    {
        return $this->_withKeys($query, $id);
    }

    /**
     * @param $query
     * @param $id
     * @return mixed
     */
    public function scopeWithKeys($query, $id)
    {
        return $this->_withKeys($query, $id);
    }

    /**
     * @param $query
     * @param $id
     * @return mixed
     */
    public function scopeWithKeysIn($query, $keys)
    {
        $keyName = (array)$this->getKeyName();
        if (is_array($keys)) {
            foreach ($keys as $key => $value) {
                if (!in_array($key, $keyName)) {
                    continue;
                }
                $query->whereIn($key, (array)$value);
            }
            return $query;
        }
        return $query->whereIn($this->getKeyName(true), (array)$keys);
    }

    /**
     * @param $query
     * @param $id
     * @return mixed
     */
    public function scopeWithParentKeysIn($query, $keys)
    {
        if (is_array($keys)) {
            foreach ($keys as $key => $value) {
                $query->whereIn($key, (array)$value);
            }
            return $query;
        }
        return $query->whereIn($this->getKeyName(true), (array)$keys);
    }

    /**
     * @param $query
     * @param $id
     * @return mixed
     */
    public function scopeWithKey($query, $id)
    {
        return $this->_withKeys($query, $id);
    }

    protected function _withKeys($query, $id)
    {
        if (is_array($id)) {
            foreach ($id as $key => $value) {
                $query->where($key, '=', $value);
            }
            return $query;
        }
        return $query->where($this->getKeyName(true), '=', $id);
    }

    /**
     * @param $query
     * @param $lang
     * @return mixed
     */
    public function scopeWithLang($query, $lang)
    {
        if (is_null($lang)) {
            return $query;
        }
        return $query;
    }
}


<?php

namespace App\Model\Base;

/**
 * Trait ApiToken
 * @package App\Model\Base
 */
/**
 * Trait AutoFillInsIdUpId
 * @package App\Model\Base
 */
/**
 * Trait ApiToken
 * @package App\Model\Base
 */
trait ApiToken
{
    /**
     * @return string
     */
    public function accessTokenFieldName()
    {
        return 'access_token';
    }

    /**
     *
     */
    public function resetAccessToken()
    {
        $this->updateAccessToken();
    }

    /**
     * @return string
     */
    public function renewAccessToken()
    {
        $accessToken = $this->genAccessToken();
        $this->updateAccessToken($accessToken);
        return $accessToken;
    }

    /**
     * @param string $value
     * @return mixed
     */
    public function updateAccessToken($value = '')
    {
        $fieldName = $this->accessTokenFieldName();
        $fillable = $this->getFillable();
        $fillable[] = $fieldName;
        $this->fillable($fillable)->$fieldName = $value;
        return $this->save();
    }

    /**
     * @return string
     */
    public function genAccessToken()
    {
        $hash = implode('_', (array)$this->getKey()) . time();
        $hash = genPassword($hash);
        return $hash;
    }

}

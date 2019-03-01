<?php

namespace App\Model\Presenters;
/**
 * Trait SerialNumber
 * @package App\Model\Presenters
 */
trait SerialNumber
{
    public function genKey($serialNumber, $salt)
    {
        return sha1(sha1($salt . $serialNumber . $salt) . $salt);
    }

    public function genSerialNumber($start)
    {
        $r = rjust($start, strlen(getConstant('MAX_QUANTITY')), '0');
        return $r;
    }

}
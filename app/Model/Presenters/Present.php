<?php

namespace App\Model\Presenters;

trait Present
{
    public function isApplicationUse()
    {
        return $this->applications->first() ? true : false;
    }

    public function typeText(){
        return getTextValue('presents.types', $this->type);
    }

    public function getPointByType()
    {
        if ($this->type == getConstant('TYPE_PRESENT_1_PT')) {
            return getConstant('SCORE_PRESENT_1_PT');
        }

        if ($this->type == getConstant('TYPE_PRESENT_5_PT')) {
            return getConstant('SCORE_PRESENT_5_PT');
        }
    }

    public function is1Point()
    {
        return $this->type == getConstant('TYPE_PRESENT_1_PT');
    }
}
?>
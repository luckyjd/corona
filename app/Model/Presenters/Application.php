<?php

namespace App\Model\Presenters;
/**
 * Trait AdminUserInfo
 * @package App\Model\Presenters
 */
/**
 * Trait Application
 * @package App\Model\Presenters
 */
trait Application
{
    /**
     * @return mixed|string
     */
    public function statusText()
    {
        return getTextValue('application.statuses', $this->status);
    }
    /**
     * @return mixed|string
     */
    public function presentTypeText()
    {
        return getTextValue('presents.types', $this->present_type);
    }

    public function getDateInsert()
    {
        return date('d', strtotime($this->ins_datetime));
    }

    public function getDateUpdate() {
        return date('d', strtotime($this->upd_datetime));
    }

    public function isWinner()
    {
        return $this->status == getConstant('STATUS_WIN');
    }

    public function storeListText()
    {
        return isShow() ? $this->tryGet('shipping')->store_list : $this->store_list;
    }

    public function zipCodeText()
    {
        return '〒' . formatZipCode($this->zip_code);
    }

    public function addressText()
    {
        if(!$this->isWinner()){
            return '';
        }
        if(!isShow()){
            return $this->zipCodeText(). getTextValue('prefs', $this->pref_id) . ''. $this->address;
        }
        return $this->tryGet('shipping')->addressText();
    }
    public function getShippingFlg()
    {
        return getConfig('shipping.shipping_flg.'.$this->shipping_flg) ;
    }
}
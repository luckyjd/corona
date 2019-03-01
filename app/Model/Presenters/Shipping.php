<?php

namespace App\Model\Presenters;

trait Shipping
{
    public function addressText()
    {
        return  $this->zipCodeText(). $this->prefText() . '' . $this->address;
    }

    public function prefText()
    {
        return getTextValue('prefs', $this->pref_id);
    }

    public function telText()
    {
        return formatPhone($this->tel);
    }

    public function zipCodeText()
    {
        return '〒' .formatZipCode($this->zip_code);
    }

    public function getFullName()
    {
        return $this->last_name . ' ' . $this->first_name;
    }
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

    public function getShippingFlg()
    {
        return  $this->shipping_flg == getConstant('SHIPPING_FLG_ON') ? getConfig('shipping.shipping_flg.1') :getConfig('shipping.shipping_flg.0');
    }

}
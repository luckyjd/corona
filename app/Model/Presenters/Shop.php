<?php

namespace App\Model\Presenters;

trait Shop {
    public function addressText()
    {
        return $this->getAddress();
    }

    public function prefText()
    {
        return getTextValue('prefs', $this->pref);
    }

    public function telText()
    {
        return trim($this->tel);
    }

    public function zipCodeText()
    {
        return trim('〒' .formatZipCode($this->zip_code));
    }

    public function getFullName()
    {
        return $this->first_name . ' ' . $this->last_name;
    }
    public function getAddress()
    {
        return $this->pref . $this->address . $this->address1 . $this->address2 . $this->address3;
    }
}


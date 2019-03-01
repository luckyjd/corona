<?php

namespace App\Model\Presenters;

trait User
{
    use Shipping;
    public function getName()
    {
        return $this->last_name . ' ' . $this->first_name;
    }

    public function getPoint()
    {
        $point = $this->point;
        $text = 'danger';
        if ($point > 0 && $point < 50) {
            $text = 'info';
        }
        if ($point >=50 && $point < 120) {
            $text = 'success';
        }
        return '<span class="text-' . $text . '">' . $point . '</span>';
    }

    public function isSNSUser()
    {
        return (bool)$this->sns_id;
    }

    public function isNormalUser()
    {
        return !$this->isSNSUser();
    }

    public function typeText()
    {
        return $this->isNormalUser() ? $this->tA('normal_type') :  $this->tA('facebook_type');
    }
}
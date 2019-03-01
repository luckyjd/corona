<?php

namespace App\Model\Entities;

use App\Model\Base\Auth\User;
use Illuminate\Notifications\Notifiable;

class AdminUserInfo extends User
{
    protected $table = "admin_users";
    use Notifiable;
    use \App\Model\Presenters\AdminUserInfo;
    protected $_alias = 'admin_user_info';
    protected $fillable = ['email', 'password','name'];
    protected $urlAttributes = ['avatar'];

    protected $hidden = ['password'];

    public function setPasswordAttribute($value)
    {
        $this->attributes['password'] = genPassword($value);
    }

    public function getAuthPassword()
    {
        return $this->password;
    }

    public function setAuthPassword($password)
    {
        return $this->setPasswordAttribute($password);
    }

    public function getRememberToken()
    {
        return null; // not supported
    }

    public function setRememberToken($value)
    {
        // not supported
    }
}


<?php

namespace App\Model\Entities;

use Illuminate\Notifications\Notifiable;

class User extends \App\Model\Base\Auth\User
{
    use Notifiable;
    use \App\Model\Presenters\User;
    protected $_alias = 'users';
    protected $table = 'users';
    protected $fillable = [
        'first_name', 'last_name', 'email', 'password', 'point', 'address', 'tel', 'zip_code',
        'address1', 'address2', 'address3', 'store_list', 'pref_id'
    ];
    protected static $_destroyRelations = [
        'applications'
    ];

    public function applications()
    {
        return $this->hasMany(Application::class, 'user_id', 'id');
    }

    public function socialProfile()
    {
        return $this->hasMany(SocialLoginProfile::class, 'user_id', 'id');
    }

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
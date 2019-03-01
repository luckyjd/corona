<?php

namespace App\Model\Entities;

use App\Model\Base\ModelSoftDelete;

class SocialLoginProfile extends ModelSoftDelete
{
    protected $table = 'social_login_profiles';
}
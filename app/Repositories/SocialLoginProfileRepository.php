<?php

namespace App\Repositories;

use App\Model\Entities\SocialLoginProfile;
use App\Repositories\Base\CustomRepository;

class SocialLoginProfileRepository extends CustomRepository
{
    function model()
    {
        return SocialLoginProfile::class;
    }

    public function validator()
    {
        return \App\Validators\SocialLoginProfile::class;
    }
}
?>
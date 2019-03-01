<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Base\FrontendController;
use App\Model\Entities\User;
use App\Repositories\UserRepository;
use App\Http\Supports\RepositoryUtil;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Input;

class UserController extends FrontendController
{
    // use: triat
    use RepositoryUtil;

    public function __construct(UserRepository $repository)
    {
        parent::__construct();

        // register repositories
        $this->setRepository($repository);

    }
}

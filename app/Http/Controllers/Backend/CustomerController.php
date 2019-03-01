<?php
namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Base\BackendController;
use App\Repositories\UserRepository;

/**
 * Class CustomerController
 * @package App\Http\Controllers\Backend
 */
class CustomerController extends BackendController
{
    /**
     * CustomerController constructor.
     * @param UserRepository $userRepository
     */
    public function __construct(UserRepository $userRepository)
    {
        parent::__construct();
        $this->setRepository($userRepository);
        $this->setBackUrlDefault('customer.index');
    }
}
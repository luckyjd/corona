<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Base\BackendController;
use App\Repositories\AdminUserInfoRepository;
use Illuminate\Support\MessageBag;
use Illuminate\Support\Facades\Input;
use Validator;

/**
 * Class AdminController
 * @package App\Http\Controllers\Auth
 */
class AdminController extends BackendController
{
    protected $_area = 'backend';

    protected $_userLoginHistoryRepository = null;

    /**
     * @return null
     */
    public function getUserLoginHistoryRepository()
    {
        return $this->_userLoginHistoryRepository;
    }

    /**
     * @param null $userLoginHistoryRepository
     */
    public function setUserLoginHistoryRepository($userLoginHistoryRepository)
    {
        $this->_userLoginHistoryRepository = $userLoginHistoryRepository;
    }

    public function __construct(AdminUserInfoRepository $userInfoRepository)
    {
        $this->setRepository($userInfoRepository);
        parent::__construct();
    }

    public function login()
    {
        if (backendGuard()->check()) {
            return $this->_redirectToHome();
        }
        return $this->render('backend.auth.admin.login');
    }

    public function postLogin()
    {
        $validator = $this->getRepository()->getValidator();
        if (!$validator->validateLogin(Input::all())) {
            return $this->_backWithError($validator->errors());
        }

        $userData = array(
            'email' => Input::get('email'),
            'password' => Input::get('password')
        );

        if (backendGuard()->attempt($userData)) {
            return $this->_redirectToHome();

        }
        $errors = new MessageBag(['password' => [trans('auth.email_password_invalid')]]);
        return $this->_backWithError($errors);
    }

    protected function _backWithError($errors)
    {
        return $this->_back()
            ->withErrors($errors)// send back all errors to the login form
            ->withInput(Input::except('password')); // send back the input (not the password) so that we can repopulate the form
    }

    public function logout()
    {
        backendGuard()->logout(); // log the user out of our application
        return $this->_redirectToHome();
    }

    protected function _redirectToHome()
    {
        $url = Input::get('return_url', '');
        $routeUrl = route($this->getCurrentRouteName());
        if (!$url || $url == $routeUrl || $this->getCurrentAction() == 'login') {
            $url = getBackendAlias();
        }
        return $this->_to($url);
    }
}

<?php

namespace App\Http\Controllers\Backend\Auth;

use App\Http\Controllers\Base\BackendController;
use App\Repositories\AdminUserInfoRepository;
use Illuminate\Support\MessageBag;
use Illuminate\Support\Facades\Input;
use Validator;

class LoginController extends BackendController
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

    public function showLoginForm()
    {
        if(backendGuard()->check()){
            return $this->_redirectToHome();
        }
        $this->setEntity($this->_findOrNewEntity());
        return $this->render('backend.auth.login');
    }

    public function login()
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
        $url = Input::get('return_url', buildDashBoardUrl());
        $url = empty($url) ? buildDashBoardUrl() : $url;
        return $this->_to($url);
    }

}

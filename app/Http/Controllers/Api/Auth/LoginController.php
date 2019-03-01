<?php

namespace App\Http\Controllers\Api\Auth;

use App\Http\Controllers\Base\ApiController;
use App\Repositories\AdminUserInfoRepository;
use Illuminate\Support\Facades\Input;

class LoginController extends ApiController
{
    protected $_area = 'api';
    protected $_accessToken = '';

    public function __construct(AdminUserInfoRepository $userInfoRepository)
    {
        $this->setRepository($userInfoRepository);
        parent::__construct();
    }

    /**
     * @return string
     */
    public function getAccessToken()
    {
        return $this->_accessToken;
    }

    /**
     * @param string $accessToken
     */
    public function setAccessToken($accessToken)
    {
        $this->_accessToken = $accessToken;
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

        if (apiGuard()->attempt($userData)) {
            $this->getCurrentUser()->renewAccessToken();
            $this->setAccessToken($this->getCurrentUser()->access_token);
            return $this->_redirectToHome();

        }
        return $this->_backWithError([trans('auth.email_password_invalid')]);
    }

    protected function _backWithError($errors)
    {
        $this->setMessage($errors);
        return $this->renderErrorJson();
    }

    public function logout()
    {
        $this->getCurrentUser()->resetAccessToken();
        apiGuard()->logout(); // log the user out of our application
        return $this->_redirectToHome();
    }

    protected function _redirectToHome()
    {
        $this->setData([
            'access_token' => $this->getAccessToken()
        ]);
        return $this->renderJson();
    }

}

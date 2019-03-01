<?php

namespace App\Http\Controllers\Api\Auth;

use App\Http\Controllers\Base\ApiController;
use App\Mail\Api\ResetPassword;
use App\Repositories\AdminUserInfoRepository;
use Illuminate\Foundation\Auth\SendsPasswordResetEmails;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Mail;

class ForgotPasswordController extends ApiController
{
    /*
    |--------------------------------------------------------------------------
    | Password Reset Controller
    |--------------------------------------------------------------------------
    |
    | This controller is responsible for handling password reset emails and
    | includes a trait which assists in sending these notifications from
    | your application to your users. Feel free to explore this trait.
    |
    */

    use SendsPasswordResetEmails;

    protected $_area = 'api';

    /**
     * ForgotPasswordController constructor.
     * @param AdminUserInfoRepository $repository
     */
    public function __construct(AdminUserInfoRepository $repository)
    {
        $this->setRepository($repository);
        $this->middleware('guest');
        parent::__construct();
    }

    public function showLinkRequestForm()
    {
        if (apiGuard()->check()) {
            return $this->_redirectToHome();
        }
        return $this->render('api.auth.password.request');
    }

    public function sendResetLinkEmail()
    {
        $valid = $this->getRepository()->getValidator()->validateResetPassword(Input::all());
        if (!$valid) {
            return $this->_back()->withInput(Input::all())->withErrors($this->getRepository()->getValidator()->errorsBag());
        }
        $email = Input::get('email');
        $now = date('YmdHis');
        $prefix = getConstant('RESET_PASSWORD_PREFIX');
        $hash = $email . $prefix . $now;
        $hash = encrypt($hash);
        try {
            $user = $this->getRepository()->where('email', $email)->first();
            if (!empty($user)) {
                Mail::to($email)->send(new ResetPassword($hash, $user));
            }
        } catch (\Exception $exception) {
            logError($exception->getMessage());
            return $this->_back()->withErrors(['email' => trans('messages.send_failed')]);
        }

        return $this->_back()->withSuccess(trans('messages.send_reset_link_success', ['email' => $email]));
    }
}

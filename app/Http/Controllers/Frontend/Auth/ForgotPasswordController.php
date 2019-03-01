<?php

namespace App\Http\Controllers\Frontend\Auth;

use App\Http\Controllers\Base\FrontendController;
use App\Mail\Frontend\ResetPassword;
use App\Repositories\UserRepository;
use Illuminate\Foundation\Auth\SendsPasswordResetEmails;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Mail;

class ForgotPasswordController extends FrontendController
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

    protected $_area = 'frontend';

    /**
     * ForgotPasswordController constructor.
     * @param UserRepository $user
     */
    public function __construct(UserRepository $repository)
    {
        $this->setRepository($repository);
        $this->middleware('guest');
        parent::__construct();
    }

    public function showLinkRequestForm()
    {
        if (frontendGuard()->check()) {
            return $this->_redirectToHome();
        }
        return $this->render('frontend.auth.password.request');
    }

    public function sendResetLinkEmail()
    {
        $valid = $this->getRepository()->getValidator()->validateResetPassword(Input::all());
        if (!$valid) {
            $this->setOk(false);
            $this->setMessage($this->getRepository()->getValidator()->errors());
            return $this->renderJson();
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
                $this->setMessage(trans('messages.send_reset_link_success', ['email' => $email]));
                return $this->renderJson();
            }
        } catch (\Exception $exception) {
            logError($exception->getMessage());
            $this->setOk(false);
            $this->setMessage(trans('messages.send_failed'));
            return $this->renderJson();
        }

    }
}

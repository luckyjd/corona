<?php

namespace App\Http\Controllers\Frontend\Auth;

use App\Http\Controllers\Base\FrontendController;
use App\Repositories\UserRepository;
use Carbon\Carbon;
use Illuminate\Foundation\Auth\ResetsPasswords;
use Illuminate\Support\Facades\Input;

class ResetPasswordController extends FrontendController
{
    /*
    |--------------------------------------------------------------------------
    | Password Reset Controller
    |--------------------------------------------------------------------------
    |
    | This controller is responsible for handling password reset requests
    | and uses a simple trait to include this behavior. You're free to
    | explore this trait and override any methods you wish to tweak.
    |
    */

    use ResetsPasswords;

    /**
     * Where to redirect users after resetting their password.
     *
     * @var string
     */
    protected $redirectTo = '/home';

    protected $_area = 'frontend';

    /**
     * ResetPasswordController constructor.
     * @param UserRepository $repository
     */
    public function __construct(UserRepository $repository)
    {
        $this->setRepository($repository);
        $this->middleware('guest');
        parent::__construct();
    }

    public function showResetForm($hash)
    {
        if (frontendGuard()->check()) {
            return $this->_redirectToHome();
        }
        if (!$hash) {
            return redirect()->route('frontend.login')->withErrors(trans('messages.failed'));
        }
        $this->setEntity($this->_findOrNewEntity());
        try {
            list($email, $time) = $this->_parseParams($hash);
            $entity = $this->_getEntity($email, $time);
            if (empty($entity)) {
                return redirect()->route('frontend.login')->withErrors(trans('messages.failed'));
            }
            $this->setViewData(['token' => $hash]);
            $this->setEntity($entity);
        } catch (\Exception $exception) {
            logError($exception->getMessage());
        }

        return $this->render('frontend.auth.password.reset');
    }

    protected function _parseParams($hash)
    {
        $hash = decrypt($hash);
        $hash = explode(getConstant('RESET_PASSWORD_PREFIX'), $hash);
        $email = array_get($hash, 0);
        $time = array_get($hash, 1);
        return [$email, $time];
    }

    protected function _getEntity($email, $time)
    {
        if (!$email || !$time) {
            return false;
        }
        $time = Carbon::parse($time);
        $now = Carbon::now();
        $lengthOfAd = $time->diffInMinutes($now);
        if ($lengthOfAd > getConstant('RESET_PASSWORD_TIMEOUT')) {
            return false;
        }
        $entity = $this->getRepository()->where('email', $email)->first();
        if (empty($entity)) {
            return false;
        }
        return $entity;
    }

    public function reset()
    {
        if (!Input::get('token')) {
            return $this->_to(route('frontend.login'));
        }
        $params = $this->_getParams();
        $valid = $this->getRepository()->getValidator()->validateConfirmReset($params);
        if (!$valid) {
            $this->setOk(false);
            $this->setMessage($this->getRepository()->getValidator()->errors());
            return $this->renderJson();
        }

        try {
            list($email, $time) = $this->_parseParams(Input::get('token'));
            $entity = $this->_getEntity($email, $time);
            if (empty($entity)) {
                $this->setOk(false);
                $this->setMessage(trans('messages.failed'));
                return $this->renderJson();
            }
            $entity = $this->getRepository()->where('email', $email)->first();
            $entity->password = $params['password'];
            $entity->save();
        } catch (\Exception $e) {
            logError($e->getMessage());
            $this->setOk(false);
            $this->setMessage(trans('messages.failed'));
            return $this->renderJson();
        }
        $this->setMessage(trans('messages.reset_password_success'));
        return $this->renderJson();
    }
}

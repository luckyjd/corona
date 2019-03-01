<?php

namespace App\Http\Controllers\Api\Auth;

use App\Http\Controllers\Base\ApiController;
use App\Repositories\AdminUserInfoRepository;
use Carbon\Carbon;
use Illuminate\Foundation\Auth\ResetsPasswords;
use Illuminate\Support\Facades\Input;

class ResetPasswordController extends ApiController
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

    protected $_area = 'api';

    /**
     * ResetPasswordController constructor.
     * @param AdminUserInfoRepository $repository
     */
    public function __construct(AdminUserInfoRepository $repository)
    {
        $this->setRepository($repository);
        $this->middleware('guest');
        parent::__construct();
    }

    public function showResetForm($hash)
    {
        if (apiGuard()->check()) {
            return $this->renderErrorJson();
        }
        if (!$hash) {
            return redirect()->route('api.login')->withErrors(trans('messages.failed'));
        }
        $this->setEntity($this->_findOrNewEntity());
        try {
            list($email, $time) = $this->_parseParams($hash);
            $entity = $this->_getEntity($email, $time);
            if (empty($entity)) {
                return redirect()->route('api.login')->withErrors(trans('messages.failed'));
            }
            $this->setViewData(['token' => $hash]);
            $this->setEntity($entity);
        } catch (\Exception $exception) {
            logError($exception->getMessage());
        }

        return $this->render('api.auth.password.reset');
    }

    protected function _parseParams($hash)
    {
        $hash = decrypt($hash);
        $hash = explode(getConstant('RESET_PASSWORD_PREFIX'), $hash);
        return $hash;
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
            return $this->_to(route('api.login'));
        }
        $params = $this->_getParams();
        $valid = $this->getRepository()->getValidator()->validateConfirmReset($params);
        if (!$valid) {
            return $this->_back()->withErrors($this->getRepository()->getValidator()->errorsBag())
                ->withInput();
        }

        try {
            list($email, $time) = $this->_parseParams(Input::get('token'));
            $entity = $this->_getEntity($email, $time);
            if (empty($entity)) {
                return redirect()->route('api.login')->withErrors(trans('messages.failed'));
            }
            $entity = $this->getRepository()->where('email', $email)->first();
            $entity->password = $params['password'];
            $entity->save();
            return redirect()->route('api.login')->withSuccess(trans('messages.reset_password_success'));
        } catch (\Exception $e) {
            logError($e->getMessage());
            return redirect()->route('api.login')->withErrors(trans('messages.failed'));
        }
    }
}

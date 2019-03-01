<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Base\FrontendController;
use App\Mail\Frontend\RegisterSuccess;
use App\Repositories\SocialLoginProfileRepository;
use App\Repositories\UserRepository;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Session;

class RegisterController extends FrontendController
{
    protected $_socialLoginProfileRepository = null;

    /**
     * @return null
     */
    public function getSocialLoginProfileRepository()
    {
        return $this->_socialLoginProfileRepository;
    }

    /**
     * @param null $socialLoginProfileRepository
     */
    public function setSocialLoginProfileRepository($socialLoginProfileRepository)
    {
        $this->_socialLoginProfileRepository = $socialLoginProfileRepository;
    }

    public function __construct(UserRepository $userRepository, SocialLoginProfileRepository $socialLoginProfileRepository)
    {
        $this->setRepository($userRepository);
        $this->setSocialLoginProfileRepository($socialLoginProfileRepository);
        parent::__construct();
        $this->setBackUrlDefault('home');
    }

    public function ajaxRegisterUser(){
        $params = Input::post();
        $fromSocial = !empty($params['from_social']) ? $params['from_social'] : false; // facebook/google/twitter
        if (!$fromSocial){
            Session::forget('login_social_id');
        }

        if (!$this->getRepository()->getValidator()->validateCreate($params)) {
            $this->setOk(false);
            $this->setMessage($this->getRepository()->getValidator()->errors());
            return $this->renderJson();
        }

        $entity = $this->getRepository()->firstOrNew(array('email' => $params['email']));
        if ($entity->exists){
            $this->setOk(false);
            $this->setMessage('message.email_exist');
            return $this->renderJson();
        }

        DB::beginTransaction();
        try {
            $entity->fill($params);
            $this->_moveFileFromTmpToMedia($entity);
            $entity->save();
            if ($fromSocial){ // save social_login_profiles
                $socialField = $fromSocial . '_id';
                $socialId = Session::get('login_social_id');
                $socialId = !empty($socialId[$socialField]) ? $socialId[$socialField] : false;
                if (!$socialId){ // error session
                    DB::rollBack();
                    $this->setOk(false);
                    $this->setMessage(trans('messages.create_failed'));
                    return $this->renderJson();
                }
                $userSocial = $this->getSocialLoginProfileRepository()->firstOrNew(array('user_id' => $entity->id, $socialField => $socialId));
                $userSocial->save();
            }
            $this->_saveRelations($entity);
            // add new
            DB::commit();
            $this->fireEvent('after_store', $entity);
            Session::forget('login_social_id');
            $email = $entity->email;
            try {
                $user = $this->getRepository()->where('email', $email)->first();
                if (!empty($user)) {
                    Mail::to($email)->send(new RegisterSuccess($params));
                    $this->setMessage(trans('messages.register_success', ['email' => $email]));
                    return $this->renderJson();
                }
            } catch (\Exception $exception) {
                logError($exception->getMessage());
            }
            $this->setMessage(trans('messages.create_success'));
            return $this->renderJson();
        } catch (\Exception $e) {
            logError($e);
            $this->_removeMediaFile(isset($entity) ? $entity : null);
            DB::rollBack();
        }

        $this->setOk(false);
        $this->setMessage(trans('messages.create_failed'));
        return $this->renderJson();
    }
}

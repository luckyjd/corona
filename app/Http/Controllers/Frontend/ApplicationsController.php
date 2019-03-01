<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Base\FrontendController;
use App\Model\Entities\Shipping;
use App\Repositories\ApplicationRepository;
use App\Repositories\PresentRepository;
use App\Repositories\SerialNumberRepository;
use App\Repositories\ShippingRepository;
use App\Repositories\UserRepository;
use App\Http\Supports\RepositoryUtil;
use App\Services\PresentService;
use Illuminate\Support\Facades\DB;

class ApplicationsController extends FrontendController
{
    use RepositoryUtil;

    protected $_presentService;

    public function setService($presentService)
    {
        $this->_presentService = $presentService;
    }

    public function getService()
    {
        return $this->_presentService;
    }

    public function __construct(
        PresentRepository $repository, UserRepository $userRepository,
        ApplicationRepository $applicationRepository, PresentService $presentService,
        SerialNumberRepository $serialNumberRepository, ShippingRepository $shippingRepository)
    {
        parent::__construct();

        // register repositories
        $this->setRepository($repository);
        $this->registerRepository($userRepository, $applicationRepository, $serialNumberRepository, $shippingRepository);

        // register services
        $this->setService($presentService);
    }

    public function applySerial($serial, $key)
    {
        $arrSerial = [
            'serial' => $serial,
            'key' => $key
        ];
        if (!frontendGuard()->check()) {
            session()->put('serial', $arrSerial);
            session()->put('login_dialog', true);
            return $this->_redirectToHome();
        }

        $userId = $this->getCurrentUser()->id;
        $user =  $this->fetchRepository(UserRepository::class)->findById($userId);


        $pointLimited = getConstant('POINT_LIMITED');
        if ($user->point >= $pointLimited) {
            session()->put('point_limited', true);
            return redirect(route('my_page'));
        }

        $serialNumber = $this->fetchRepository(SerialNumberRepository::class)->getSerialNumber([
            'serial_number_eq' => $serial,
            'key_eq' => $key
        ]);


        if (empty($serialNumber)) {
            return redirect(route('my_page'))->withErrors(trans('messages.serial_is_invalid'));
        }

        DB::beginTransaction();
        try {
            $serialNumber->update(['user_id' => $user->getKey()]);
            $user->point += 1;
            $user->save();
            // add new
            DB::commit();
            return redirect(route('my_page'));
        } catch (\Exception $e) {
            logError($e);
            DB::rollBack();
        }
        return redirect(route('my_page'))->withErrors(trans('messages.create_failed'));
    }

    public function presents()
    {
        $viewData = [
            'presentsOnePt' => $this->getRepository()->getPresentsOnePtForFrontend(),
            'presentsFivePt' => $this->getRepository()->getPresentsFivePtForFrontend(),
        ];

        $this->setViewData($viewData);
        return $this->render('frontend.applications.game_x.index');
    }

    public function playGame()
    {
        $presentId = request('id');
        $present = $this->getRepository()->getRemainPresent($presentId);
        $userId = $this->getCurrentUser()->id;
        $user =  $this->fetchRepository(UserRepository::class)->findById($userId);
        $presentName = $present['name'];
        if ($user->point <=0) {
            $this->setData([
                'is_win' => false,
                'html' => $this->render('frontend.applications.game_x.not_win')->render(),
            ]+ $this->_getDataAfterPlayGame($user));
            $this->setMessage(trans('messages.user_no_win'));
            return $this->renderJson();
        }

        DB::beginTransaction();
        try {
            // minus score of user with present user choose
            $user->point -= $present->getPointByType();
            if ($user->point < 0) {
                logInfo(trans('messages.user_not_enough_point'));
                $this->setMessage(trans('messages.user_no_win'));
                $this->setData([
                    'is_win' => false,
                    'html' => $this->render('frontend.applications.game_x.not_win')->render(),
                ]);
                return $this->renderJson();
            }
            $user->save();

            $totalUserPoints = $this->fetchRepository(UserRepository::class)->getTotalPoints();
            $serialNumber = $this->fetchRepository(SerialNumberRepository::class)->countSerialNumber();
            $isWin = $this->getService()->isWin($this->getRepository()->sumRemainPresents(), ($totalUserPoints + $serialNumber));
            $paramsInsertApplicationTable = ['user_id' => $userId, 'present_id' => $presentId];
            $applicationEntity = $this->fetchRepository(ApplicationRepository::class);
            // If user wined, insert applications table with status = 1, decreasing the number of present for 1
            if ($isWin) {
                session()->put('present_id', $presentId);
                session()->put('present_name', $presentName);
                // Decrease present for 1
                $this->getRepository()->decreasePresentForOne($presentId);

                $tmp = $user->only(['first_name', 'last_name', 'email', 'zip_code', 'pref_id', 'address', 'address1', 'address2', 'address3', 'tel']);

                // Insert to applications table with user win
                $paramsInsertApplicationTable += ['status' => getConstant('STATUS_USER_WIN')];
                $applicationEntity = $applicationEntity->create($paramsInsertApplicationTable);
                if ($applicationEntity) {
                    $applicationId = $applicationEntity->id;

                    // Save session applicationId
                    session()->put('applicationId', $applicationId);

                    // Insert to shipping table
                    $shipping =$this->fetchRepository(ShippingRepository::class);
                    $tmp['application_id'] = $applicationId;
                    $shipping->create($tmp);
                }
                $this->setMessage(trans('messages.user_win'));
            } else {
                // Insert to applications table with user no win
                $paramsInsertApplicationTable += ['status' => getConstant('STATUS_USER_NO_WIN')];
                $applicationEntity->create($paramsInsertApplicationTable);
                $this->setMessage(trans('messages.user_no_win'));
            }
            DB::commit();
            $this->setData([
                'is_win' => $isWin,
                'html' => $this->render($isWin ? 'frontend.applications.game_x.is_win' : 'frontend.applications.game_x.not_win', ['entity' => $present])->render(),
            ] + $this->_getDataAfterPlayGame($user));
            return $this->renderJson();
        } catch (\Exception $e) {
            logError($e);
            DB::rollBack();
        }
        $this->setData([
            'is_win' => false,
            'html' => $this->render('frontend.applications.game_x.not_win')->render(),
            ] + $this->_getDataAfterPlayGame($user));
        $this->setMessage(trans('messages.user_no_win'));
        return $this->renderJson();
    }

    protected function _getDataAfterPlayGame($user)
    {
        return [
            'user_info' => $this->render('frontend.applications.user_info', ['currentUser' => $user])->render(),
            'user_point' => $user->point,
            'presents_one_pt' => $this->render('frontend.applications.present1', ['presentsOnePt' => $this->getRepository()->getPresentsOnePtForFrontend(), 'currentUser' => $user])->render(),
            'presents_five_pt' => $this->render('frontend.applications.present5', ['presentsFivePt' => $this->getRepository()->getPresentsFivePtForFrontend(), 'currentUser' => $user])->render(),
        ];
    }

    public function displayMyPage()
    {
        if (session()->has('serial')) {
            return $this->_autoApplySerialAfterLogin();
        }

        $viewData = [
            'presentsOnePt' => $this->getRepository()->getPresentsOnePtForFrontend(),
            'presentsFivePt' => $this->getRepository()->getPresentsFivePtForFrontend(),
            'currentUser' => $this->getCurrentUser()
        ];

        $this->setViewData($viewData);
        return $this->render('frontend.applications.my_page');
    }

    public function confirmPlayGame()
    {
        $presentId = request('id');
        $present = $this->getRepository()->findById($presentId);
        if (!$present) {
            return $this->renderErrorJson();
        }
        $this->setEntity($present);
        $this->setData(['present' => $present, 'html' => $this->render('frontend.applications.game_x.present')->render()]);
        return $this->renderJson();
    }
    public function displayTerms(){
        return $this->render('frontend.policy-term.term');
    }
    
    public function displayPolicy(){
        return $this->render('frontend.policy-term.policy');
    }
}

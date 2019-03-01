<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Base\FrontendController;
use App\Mail\Frontend\CongratsAdmin;
use App\Mail\Frontend\CongratsCustomer;
use App\Repositories\AdminUserInfoRepository;
use App\Repositories\ShippingRepository;
use App\Http\Supports\RepositoryUtil;
use App\Repositories\UserRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;

class ShippingController extends FrontendController
{
    // use: trait
    use RepositoryUtil;

    public function __construct(ShippingRepository $repository, UserRepository $userRepository, AdminUserInfoRepository $adminUserInfoRepository)
    {
        parent::__construct();

        // register repositories
        $this->setRepository($repository);
        $this->registerRepository($userRepository, $adminUserInfoRepository);
    }

    public function ajaxUpdateAddressShipUser(Request $request)
    {
        $params = $this->_getParams();

        // validate params input address shipping
        if (!$this->fetchRepository(UserRepository::class)->getValidator()->validateUpdateAddressShip($params)) {
            $this->setMessage($this->fetchRepository(UserRepository::class)->getValidator()->errors());
            return $this->renderErrorJson();
        }

        DB::beginTransaction();
        try {
            $applicationId = session()->get('applicationId');
            $shipping = $this->getRepository()->getShippingByApplicationId($applicationId);

            if ($shipping) {
                $shipping->update($request->all());

                // Update info user if corresponding field is null
                $userId = getCurrentUserId();
                $user = $this->fetchRepository(UserRepository::class)->findById($userId);
                $fields = ['first_name', 'last_name', 'email', 'zip_code', 'pref_id', 'address', 'tel'];

                foreach ($fields as $field) {
                    if (!empty($user->{$field})) {
                        continue;
                    }
                    $user->{$field} = $shipping->{$field};
                }
                $user->save();
            }
            DB::commit();
            $this->setMessage(trans('messages.update_address_ship_success'));
            $emailAdmins = $this->fetchRepository(AdminUserInfoRepository::class)->getListEmail();

            try {
                $user = $params['email'];;
                if (!empty($user)) {
                    Mail::to($user)->send(new CongratsCustomer($params));

                    if (!empty($emailAdmins)) {
                        $params['presentName'] = session('present_name');
                        Mail::to($emailAdmins)->send(new CongratsAdmin($params));
                    }
                    return $this->renderJson();
                }
            } catch (\Exception $exception) {
                logError($exception->getMessage());
            }
            session()->forget('applicationId');
            session()->forget('present_name');
            return $this->renderJson();
        } catch (\Exception $e) {
            logError($e);
            DB::rollBack();
        }

        $this->setMessage(trans('messages.create_failed'));
        return $this->renderErrorJson();
    }
}

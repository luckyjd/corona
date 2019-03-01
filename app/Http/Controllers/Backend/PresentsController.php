<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Base\BackendController;
use App\Repositories\PresentRepository;
use Illuminate\Support\Facades\DB;

/**
 * Class PresentsController
 * @package App\Http\Controllers\Backend
 */
class PresentsController extends BackendController
{
    /**
     * PresentsController constructor.
     * @param PresentRepository $presentRepository
     */
    public function __construct(PresentRepository $presentRepository)
    {
        parent::__construct();
        $this->setRepository($presentRepository);
        $this->setBackUrlDefault('presents.index');
        $this->setConfirmRoute('presents.confirm');
    }

    public function beforeStore(&$data)
    {
        $data['remain_quantity'] = $data['quantity'];
    }

    public function destroy($id, $action = 'delete')
    {
        $id = $this->_buildParamByKey($id);

        // Check validate
        $isValid = $this->getRepository()->getValidator()->validateDestroy($id);
        if (!$isValid) {
            return $this->_backToStart()->withErrors($this->getRepository()->getValidator()->errors());
        }

        // Check present is application used
        $entity = $this->getRepository()->findForDestroy($id);
        if ($entity->isApplicationUse()) {
            return $this->_backToStart()->withErrors(trans('messages.not_delete_present'));
        }

        // Delete
        DB::beginTransaction();
        try {
            $this->fireEvent('before_destroy', $entity);
            call_user_func_array([$entity, $action], []);
            $this->_saveRelations($entity, $action);
            DB::commit();
            $this->fireEvent('after_destroy', $entity);
            return $this->_backToStart()->withSuccess(trans('messages.delete_success'));
        } catch (\Exception $e) {
            logError($e);
            DB::rollBack();
        }
        return $this->_backToStart()->withErrors(trans('messages.delete_failed'));
    }
}

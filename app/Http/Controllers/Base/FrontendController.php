<?php

namespace App\Http\Controllers\Base;

use App\Helpers\Url;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\DB;

/**
 * Class FrontendController
 * @package App\Http\Controllers\Base
 */
class FrontendController extends BaseController
{
    public function __construct()
    {
        parent::__construct();
        $this->setTitle(getConstant('FRONTEND_TITLE'));
        $this->setDescriptionContent(getConstant('FRONTEND_DESCRIPTION_CONTENT'));
    }

    /**
     * @var string
     */
    protected $_area = 'frontend';

    public function index()
    {
        return $this->render();
    }

    public function getCurrentUser()
    {
        return frontendGuard()->user();
    }

    /**
     * @param $id
     * @return mixed
     */
    public function show($id)
    {
        $id = $this->_buildParamByKey($id);
        $valid = $this->getRepository()->getValidator()->validateShow($id);
        if (!$valid) {
            return $this->_inValid();
        }
        $this->_prepareShow($id);
        return $this->render();
    }

    protected function _prepareShow($id)
    {
        return $this->setEntity($this->getRepository()->findWithRelation($id));
    }

    /**
     * @return mixed
     */
    public function create()
    {
        $this->fireEvent('before_create', $this);
        $result = $this->_prepareCreate()->render();
        $this->fireEvent('after_create', $result);
        return $result;
    }

    /**
     * @return \Illuminate\Http\RedirectResponse|mixed
     */
    public function valid()
    {
        try{
            $params = $this->_getParams();
            $this->fireEvent('before_valid', $params);
            $this->_setFormData($params);
            $this->_processFile();
            $key = $this->getRepository()->getKeyName();
            if (Input::has($key) && Input::get($key)) { //case update
                if (!$this->getRepository()->getValidator()->validateUpdate($params)) {
                    return $this->_inValid();
                }

                $result = $this->getConfirmRoute() ? $this->_toConfirm() : $this->forward($this->getCurrentController(), 'update');
                $this->fireEvent('after_valid', $result);
                return $result;
            }
            // case create
            if (!$this->getRepository()->getValidator()->validateCreate($params)) {
                return $this->_inValid();
            }
            $result = $this->getConfirmRoute() ? $this->_toConfirm() : $this->forward($this->getCurrentController(), 'store');
            $this->fireEvent('after_valid', $result);
            return $result;
        }catch (\Exception $exception){
            logError($exception);
        }
        return $this->_inValid(trans('messages.failed'));
    }

    /**
     * @return $this|mixed
     */
    public function confirm()
    {
        $this->fireEvent('before_confirm', $this);
        if ($this->_emptyFormData()) {
            return $this->_backToStart()->withErrors(array(
                trans('validation.not_empty', ['attribute' => 'data'])
            ));
        }
        $this->_prepareConfirm();
        $this->fireEvent('after_confirm', $this);
        return $this->render();
    }

    /**
     *
     */
    protected function _prepareConfirm()
    {
        $this->setEntity($this->_getFormData());
    }

    /**
     * @return $this
     */
    public function store()
    {
        if ($this->_emptyFormData()) {
            return $this->_backToStart()->withErrors(trans('messages.create_failed'));
        }

        $params = $this->_getFormData(false);
        if (!$this->getRepository()->getValidator()->validateCreate($params)) {
            return $this->_backToStart()->withErrors($this->getRepository()->getValidator()->errors());
        }

        DB::beginTransaction();
        try {
            $entity = $this->_findEntityForStore();
            $this->fireEvent('before_store', $entity);
            $this->_moveFileFromTmpToMedia($entity);
            $entity->save();
            $this->_saveRelations($entity);
            // add new
            DB::commit();
            $this->fireEvent('after_store', $entity);
            return $this->_backToStart()->withSuccess(trans('messages.create_success'));
        } catch (\Exception $e) {
            logError($e);
            $this->_removeMediaFile(isset($entity) ? $entity : null);
            DB::rollBack();
        }
        return $this->_backToStart()->withErrors(trans('messages.create_failed'));
    }

    /**
     * @param $id
     * @return mixed
     */
    public function edit($id)
    {
        $id = $this->_buildParamByKey($id);
        $prepare = $this->_prepareEdit($id);
        return $prepare instanceof RedirectResponse ? $prepare : $this->render();
    }

    /**
     * @param $id
     * @return $this
     */
    public function update($id)
    {
        $id = $this->_buildParamByKey($id);
        if ($this->_emptyFormData()) {
            return $this->_backToStart()->withErrors(trans('messages.update_failed'));
        }
        $params = $this->_getFormData(false);
        if (!$this->getRepository()->getValidator()->validateUpdate($params)) {
            return $this->_backToStart()->withErrors($this->getRepository()->getValidator()->errors());
        }

        DB::beginTransaction();
        try {
            $entity = $this->_findEntityForUpdate($id);
            $this->fireEvent('before_update', $entity);
            $this->_moveFileFromTmpToMedia($entity);
            $entity->save();
            // fire after save
            // fire before save relation
            $this->_saveRelations($entity);
            // fire after save relation
            // add new
            DB::commit();
            $this->fireEvent('after_update', $entity);
            return $this->_backToStart()->withSuccess(trans('messages.update_success'));
        } catch (\Exception $e) {
            logError($e);
            $this->_removeMediaFile(isset($entity) ? $entity : null);
            DB::rollBack();
        }
        return $this->_backToStart()->withErrors(trans('messages.update_failed'));
    }

    /**
     * @param $id
     * @param $action
     * @return $this
     */
    public function destroy($id, $action = 'delete')
    {
        $id = $this->_buildParamByKey($id);
        $isValid = $this->getRepository()->getValidator()->validateDestroy($id);
        if (!$isValid) {
            return $this->_backToStart()->withErrors($this->getRepository()->getValidator()->errors());
        }
        DB::beginTransaction();
        try {
            $entity = $this->getRepository()->findForDestroy($id);
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

    /**
     * @return $this
     */
    protected function _prepareCreate()
    {
        $this->setEntity($this->_findOrNewEntity(null, true));
        return $this->_prepareForm();
    }

    /**
     * @param null $id
     * @return $this
     */
    protected function _prepareEdit($id = null)
    {
        $isValid = $this->getRepository()->getValidator()->validateShow($id);
        if (!$isValid) {
            return $this->_backToStart()->withErrors($this->getRepository()->getValidator()->errors());
        }
        $this->setEntity($this->_findOrNewEntity($id, true));
        return $this->_prepareForm();
    }

    public function exportCsv()
    {
        $header = getConfig('csv.export.' . $this->getCurrentControllerName() . '.header');
        $data = [
            array_values($header)
        ];
        $entities = $this->getRepository()->getListForExport(Input::all());
        foreach ($entities as $entity) {
            $newData = [];
            foreach (array_keys($header) as $item) {
                $newData[] = $entity->{$item};
            }
            $data[] = $newData;
        }
        try {
            $filename = getConfig('csv.export.' . $this->getCurrentControllerName() . '.filename_prefix') . '_' . date('Ymd');
            // Generate and return the spreadsheet
            Excel::create($filename, function ($excel) use ($data) {
                // Build the spreadsheet, passing in the payments array
                $excel->sheet('sheet1', function ($sheet) use ($data) {
                    $sheet->fromArray($data, null, 'A1', true, false);
                });

            })->download('csv');
        } catch (\Exception $e) {
            logError($e->getMessage());
            return $this->_backToStart()->withErrors(trans('messages.failed'));
        }
    }

    /**
     * @return \Illuminate\Http\RedirectResponse
     */
    protected function _redirectToHome()
    {
        return $this->_to(getFrontendAlias());
    }

    protected function _backToStart($params = array())
    {
        $url = Url::getBackUrl(false, $this->getBackUrlDefault());
        return $this->_to($url, $params);
    }

    protected function _prepareForm()
    {
        return $this;
    }

    protected function _autoApplySerialAfterLogin()
    {
        if (session()->has('serial')) {
            $params = session()->get('serial');
            \session()->forget('serial');
            return redirect(route('application.apply.serial', $params));
        }
    }

}

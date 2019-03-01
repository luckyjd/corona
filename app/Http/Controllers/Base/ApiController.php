<?php

namespace App\Http\Controllers\Base;

use App\Helpers\Url;

/**
 * Class ApiController
 * @package App\Http\Controllers\Base
 */
class ApiController extends BaseController
{
    /**
     * @var string
     */
    protected $_area = 'api';
    use \App\Http\Supports\AjaxHandle;


    /**
     * ApiController constructor.
     */
    public function __construct()
    {
        try {
            Url::setCurrentControllerName($this->getCurrentControllerName());
            $this->setEventPrefix(getConstant('EVENT_CONTROLLER_TYPE', 'controller'));
            $this->setEventSuffix($this->getArea() . '.' . $this->getCurrentControllerName());
            parent::__construct();
        } catch (\Exception $e) {
            logError($e);
        }
    }

    /**
     * @return bool
     */
    public function getCurrentUser()
    {
        return apiGuard()->user();
    }


    /**
     *
     */
    public function index()
    {
        $entities = $this->getRepository()->getListForApi($this->_getParams());
        $this->setMetaData($entities['meta']);
        return $this->renderJson(
            [
                'data' => $entities['data']
            ]
        );
    }

    /**
     * @param $id
     * @return mixed
     */
    public function show($id)
    {
        $valid = $this->getRepository()->getValidator()->validateShow($id);
        if (!$valid) {
            return $this->_inValid();
        }
        $this->_prepareShow($id);
        return $this->renderJson([
            'data' => $this->getEntity()
        ]);
    }

    /**
     * @param null $errors
     * @return mixed
     */
    protected function _inValid($errors = null)
    {
        $errors = $errors ? $errors : $this->getRepository()->getValidator()->errors();
        $this->setMessage($errors);
        return $this->renderErrorJson();
    }
}

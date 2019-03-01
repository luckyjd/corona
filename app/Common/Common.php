<?php

use App\Helpers\Url;
use Carbon\Carbon;

if (!function_exists('getConstant')) {

    /**
     * @param $key
     * @param null $default
     * @return mixed
     */
    function getConstant($key, $default = null)
    {
        return config('constant.' . $key, $default);
    }
}
if (!function_exists('getConfig')) {

    /**
     * @param $key
     * @param null $default
     * @param $flip
     * @return mixed
     */
    function getConfig($key, $default = null, $flip = false)
    {
        $dir = 'core.' . getCurrentLangCode() . '.config.';
        if (app('config')->has($dir . $key)) {
            $r = config($dir . $key, $default);
        } else {
            $r = config('core.' . config('app.fallback_locale.' . getCurrentArea(), 'ja') . '.config.' . $key, $default);
        }
        return is_array($r) && $flip ? array_flip($r) : $r;
    }
}
if (!function_exists('getKeysConfig')) {

    /**
     * @param $key
     * @param null $default
     * @return mixed
     */
    function getKeysConfig($key, $default = null)
    {
        return array_keys(getConfig($key, $default));
    }
}
if (!function_exists('getEventName')) {

    /**
     * @param $key
     * @param null $default
     * @return mixed
     */
    function getEventName($key, $default = null)
    {
        return config('events.' . $key, $default);
    }
}
if (!function_exists('getSystemConfig')) {

    /**
     * @param $key
     * @param null $default
     * @param $flip
     * @return mixed
     */
    function getSystemConfig($key, $default = null, $flip = false)
    {
        return config('system.' . $key, $default, $flip);
    }
}
if (!function_exists('getTmpUploadDir')) {

    /**
     * @param $file
     * @return mixed
     */
    function getTmpUploadDir($file = null)
    {
        return getSystemConfig('tmp_upload_dir', 'tmp_upload') . DIRECTORY_SEPARATOR . $file;
    }
}

if (!function_exists('getTmpUploadUrl')) {

    /**
     * @param $file
     * @return mixed
     */
    function getTmpUploadUrl($file = null)
    {
        return asset(getTmpUploadDir($file));
    }
}
if (!function_exists('getTmpUploadPath')) {

    /**
     * @param $file
     * @return mixed
     */
    function getTmpUploadPath($file = null)
    {
        return public_path(getTmpUploadDir($file));
    }
}

if (!function_exists('getMediaDir')) {

    /**
     * @param $file
     * @return mixed
     */
    function getMediaDir($file = null)
    {
        return getSystemConfig('media_dir', 'media') . DIRECTORY_SEPARATOR . $file;
    }
}
if (!function_exists('getMediaUrl')) {

    /**
     * @param $file
     * @return mixed
     */
    function getMediaUrl($file = null)
    {
        return asset(getMediaDir($file));
    }
}
if (!function_exists('getMediaPath')) {

    /**
     * @param $file
     * @return mixed
     */
    function getMediaPath($file = null)
    {
        return public_path(getMediaDir($file));
    }
}
if (!function_exists('getTextValue')) {

    /**
     * @param $key
     * @param $value
     * @param null $default
     * @param $flip
     * @return mixed
     */
    function getTextValue($key, $value = null, $default = null, $flip = false)
    {
        if(is_null($value)){
            return null;
        }
        $r = getConfig($key, $default, $flip);
        return array_get($r, $value);
    }
}

// route
if (!function_exists('getBackendAlias')) {

    /**
     * @param string $key
     * @param string $default
     * @return mixed
     */
    function getBackendAlias($key = 'backend_alias', $default = 'admin')
    {
        return getSystemConfig($key, $default);
    }
}


if (!function_exists('getBackendDomain')) {

    /**
     * @param string $key
     * @param string $default
     * @return mixed
     */
    function getBackendDomain($key = 'backend_domain', $default = '')
    {
        return getSystemConfig($key, $default);
    }
}

if (!function_exists('getFrontendAlias')) {

    /**
     * @param string $key
     * @param string $default
     * @return mixed
     */
    function getFrontendAlias($key = 'frontend_alias', $default = '/')
    {
        return getSystemConfig($key, $default);
    }
}


if (!function_exists('getFrontendDomain')) {

    /**
     * @param string $key
     * @param string $default
     * @return mixed
     */
    function getFrontendDomain($key = 'frontend_domain', $default = '')
    {
        return getSystemConfig($key, $default);
    }
}


if (!function_exists('getApiAlias')) {

    /**
     * @param string $key
     * @param string $default
     * @return mixed
     */
    function getApiAlias($key = 'api_alias', $default = 'api')
    {
        return getSystemConfig($key, $default);
    }
}

if (!function_exists('getApiDomain')) {

    /**
     * @param string $key
     * @param string $default
     * @return mixed
     */
    function getApiDomain($key = 'api_domain', $default = '')
    {
        return getSystemConfig($key, $default);
    }
}

if (!function_exists('backUrl')) {

    /**
     * @param $url
     * @param $default
     * @param array $paramsDefault
     * @param array $params
     * @return \Illuminate\Contracts\Routing\UrlGenerator|string
     */
    function backUrl($url, $params = array(), $default = '', $paramsDefault = [])
    {
        return Url::backUrl($url, $params, $default, $paramsDefault);
    }
}

if (!function_exists('keepBack')) {

    /**
     * @return string
     */
    function keepBack()
    {
        return Url::keepBackUrl();
    }
}


if (!function_exists('getBackUrl')) {

    /**
     * @param bool $fromConfirm
     * @param bool $fullUrl
     * @return mixed|string
     */
    function getBackUrl($fromConfirm = false, $fullUrl = true)
    {
        return $fromConfirm ? Url::getOldUrl() : Url::getBackUrl($fullUrl);
    }
}
if (!function_exists('getBackParams')) {

    /**
     * @return mixed
     */
    function getBackParams($fromSession = false)
    {
        $r =  Input::get(Url::QUERY);
        if($fromSession){
            $urlKeys = session(Url::URl_KEY, array());
            $url = isset($urlKeys[$r]) ? $urlKeys[$r] : '';
            $parts = parse_url($url, PHP_URL_QUERY);
            parse_str($parts, $params);
            return array_get($params, Url::QUERY);
        }
        return $r;
    }
}

//entity
if (!function_exists('attr')) {

    /**
     * @param array $attrs
     * @return array
     */
    function attr($attrs = array())
    {
        return array_merge(config('entity.attributes', []), $attrs);
    }
}
// trans
if (!function_exists('transm')) {

    /**
     * @param null $id
     * @param array $replace
     * @param null $locale
     * @return array|\Illuminate\Contracts\Translation\Translator|null|string
     */
    function transm($id = null, $replace = [], $locale = null)
    {
        return trans('models.' . $id, $replace, $locale);
    }
}

if (!function_exists('transa')) {

    /**
     * @param $modelName
     * @param null $id
     * @param array $replace
     * @param null $locale
     * @return array|\Illuminate\Contracts\Translation\Translator|null|string
     */
    function transa($modelName, $id = null, $replace = [], $locale = null)
    {
        return transm($modelName . '.attributes.' . $id, $replace, $locale);
    }
}

if (!function_exists('transb')) {

    /**
     * @param null $id
     * @param array $replace
     * @param null $locale
     * @return array|\Illuminate\Contracts\Translation\Translator|null|string
     */
    function transb($id = null, $replace = [], $locale = null)
    {
        $label = '';
        $idx = explode('.', $id);
        switch ($idx[1]) {
            case 'index':
                $label = trans('actions.index');
                break;
            case 'show':
                $label = trans('actions.show');
                break;
            case 'edit':
            case 'edit_confirm':
                $label = trans('actions.edit');
                break;
            case 'create':
            case 'create_confirm':
                $label = trans('actions.create');
                break;
        }
        $check = app('translator')->has('breadcrumbs.' . $id, $replace, $locale, false);
        if (!$check) {
            $id = str_replace($idx['1'], 'name', $id);
            return trans('breadcrumbs.' . $id, $replace, $locale) . $label;
        }
        return trans('breadcrumbs.' . $id, $replace, $locale);
    }
}

if (!function_exists('tf')) {

    /**
     * translate frontend
     * @param null $id
     * @param array $replace
     * @param null $locale
     * @return array|\Illuminate\Contracts\Translation\Translator|null|string
     */
    function tf($id = null, $replace = [], $locale = null)
    {
        return transWithEditor('frontend.' . $id, $replace, $locale);
    }
}

if (!function_exists('tb')) {

    /**
     * translate frontend
     * @param null $id
     * @param array $replace
     * @param null $locale
     * @return array|\Illuminate\Contracts\Translation\Translator|null|string
     */
    function tb($id = null, $replace = [], $locale = null)
    {
        return transWithEditor('backend.' . $id, $replace, $locale);
    }
}

if (!function_exists('transWithEditor')) {

    /**
     * translate frontend
     * @param null $id
     * @param array $replace
     * @param null $locale
     * @return array|\Illuminate\Contracts\Translation\Translator|null|string
     */
    function transWithEditor($id = null, $replace = [], $locale = null)
    {
        $r = trans($id, $replace, $locale);
        return getSystemConfig('trans_with_editor') ? '<span class="trans-with-editor" data-source="' . $id . '">' . $r . '</span>' : $r;
    }
}

// pagination
if (!function_exists('paginate')) {

    /**
     * @param $key
     * @param null $default
     * @return mixed
     */
    function paginate($key, $default = null)
    {
        return config('pagination.' . $key, $default);
    }
}

if (!function_exists('backendPaginate')) {

    /**
     * @param $key
     * @param null $default
     * @return mixed
     */
    function backendPaginate($key, $default = null)
    {
        return paginate('backend.' . $key, $default);
    }
}

if (!function_exists('frontendPaginate')) {

    /**
     * @param $key
     * @param null $default
     * @return mixed
     */
    function frontendPaginate($key, $default = null)
    {
        return paginate('frontend.' . $key, $default);
    }
}

if (!function_exists('apiPaginate')) {

    /**
     * @param $key
     * @param null $default
     * @return mixed
     */
    function apiPaginate($key, $default = null)
    {
        return paginate('api.' . $key, $default);
    }
}
// guard
if (!function_exists('backendGuard')) {

    /**
     * @param string $default
     * @return mixed
     */
    function backendGuard($default = 'admins')
    {
        return Auth::guard(getSystemConfig('backend_guard', $default));
    }
}
if (!function_exists('frontendGuard')) {

    /**
     * @param string $default
     * @return mixed
     */
    function frontendGuard($default = 'frontend')
    {
        return Auth::guard(getSystemConfig('frontend_guard', $default));
    }
}
if (!function_exists('apiGuard')) {

    /**
     * @param string $default
     * @return mixed
     */
    function apiGuard($default = 'api')
    {
        return Auth::guard(getSystemConfig('api_guard', $default));
    }
}
if (!function_exists('getCurrentUserId')) {

    /**
     * @param string $default
     * @return mixed
     */
    function getCurrentUserId($default = 0)
    {
        try {
            if (\App::runningInConsole()) {
                return getSystemConfig('default_auth_id', $default);
            }
            if (backendGuard()->user() && isBackend()) {
                return backendGuard()->user()->getKey();
            }
            if (frontendGuard()->user() && !isBackend()) {
                return frontendGuard()->user()->getKey();
            }
            if (apiGuard()->user() && isApi()) {
                return apiGuard()->user()->getKey();
            }
        } catch (\Exception $e) {

        }
        return $default;
    }
}
if (!function_exists('getCurrentLangCode')) {

    /**
     * @param string $default
     * @return mixed
     */
    function getCurrentLangCode($default = 'ja')
    {
        try {
            $lang = \Illuminate\Support\Facades\Session::get(getLocaleKey(), config('app.locale.' . getCurrentArea(), $default));
            return $lang;
        } catch (\Exception $e) {

        } catch (\Error $error) {

        }
        return config('app.locale.' . getCurrentArea(), $default);
    }
}

function getLocaleKey()
{
    return isBackend() ? 'locale_backend' : 'locale_frontend';
}

// utils
if (!function_exists('toUnderScore')) {

    /**
     * @param $string
     * @return string
     */
    function toUnderScore($string)
    {
        return strtolower(preg_replace('/(?<!^)[A-Z]/', '_$0', $string));
    }
}

if (!function_exists('toCameCase')) {

    /**
     * @param $string
     * @return string
     */
    function toCameCase($string)
    {
        return lcfirst(str_replace(' ', '', ucwords(str_replace('_', ' ', $string))));
    }
}

if (!function_exists('isMulti')) {

    /**
     * @param $array
     * @return bool
     */
    function isMulti($array)
    {
        return (count($array) != count($array, 1));
    }
}
//log
if (!function_exists('logInfo')) {

    /**
     * @param $message
     * @param array $context
     */
    function logInfo($message, array $context = [])
    {
        ChannelLog::info('info', $message, $context);
    }
}
if (!function_exists('logError')) {

    /**
     * @param $message
     * @param array $context
     */
    function logError($message, array $context = [])
    {
        try {
            ChannelLog::error('error', $message, $context);
        } catch (\Exception $e) {

        }
    }
}
if (!function_exists('logDebug')) {

    /**
     * @param $message
     * @param array $context
     */
    function logDebug($message, array $context = [])
    {
        ChannelLog::debug('debug', $message, $context);
    }
}
if (!function_exists('logApi')) {

    /**
     * @param $message
     * @param array $context
     */
    function logApi($message, array $context = [])
    {
        ChannelLog::info('api', $message, $context);
    }
}
if (!function_exists('logWarn')) {

    /**
     * @param $message
     * @param array $context
     */
    function logWarn($message, array $context = [])
    {
        ChannelLog::warning('warn', $message, $context);
    }
}
//breadcrumbs
if (!function_exists('breadcrumbConfirm')) {

    /**
     * @param $breadcrumbs
     * @param $screen
     * @param $subParent
     * @return mixed
     */
    function breadcrumbConfirm($breadcrumbs, $screen, $subParent = false)
    {
        $parent = $subParent ? 'create' : 'index';
        $keys = (array)getViewData('model')->getKeyName();
        $check = true;
        foreach ($keys as $key) {
            if (!Input::has($key)) {
                $check = false;
                break;
            }
        }
        if ($check) {
            $parent = $subParent ? 'edit' : $parent;
            $breadcrumbs->parent($screen . '.' . $parent);
            return $breadcrumbs->push(transb($screen . '.edit_confirm'));
        }
        $breadcrumbs->parent($screen . '.' . $parent);
        $breadcrumbs->push(transb($screen . '.create_confirm'));
    }
}
if (!function_exists('breadcrumbOther')) {

    /**
     * @param $breadcrumbs
     * @param $screen
     * @param null $parent
     * @param $allowLink
     * @param $params
     */
    function breadcrumbOther($breadcrumbs, $name, $parent = null, $allowLink = true, $params = [])
    {
        $parent ? $breadcrumbs->parent($parent) : null;
        $breadcrumbs->push(transb($name), $allowLink ? route($name, $params) : null, ['allowLink' => $allowLink]);
    }
}
if (!function_exists('breadcrumbCreate')) {

    /**
     * @param $breadcrumbs
     * @param $screen
     */
    function breadcrumbCreate($breadcrumbs, $screen)
    {
        $breadcrumbs->parent($screen . '.index');
        $route = $screen . '.create';
        $breadcrumbs->push(transb($route), route($route));
    }
}

if (!function_exists('breadcrumbEdit')) {

    /**
     * @param $breadcrumbs
     * @param $screen
     */
    function breadcrumbEdit($breadcrumbs, $screen)
    {
        $breadcrumbs->parent($screen . '.index');
        $route = $screen . '.edit';
        $params = [];
        foreach ((array)getViewData('model')->getKeyName() as $key) {
            $params[] = \Illuminate\Support\Facades\Input::get($key, 0);
        }
        $breadcrumbs->push(transb($route), route($route, $params));
    }
}

if (!function_exists('breadcrumbShow')) {

    /**
     * @param $breadcrumbs
     * @param $screen
     */
    function breadcrumbShow($breadcrumbs, $screen)
    {
        $breadcrumbs->parent($screen . '.index');
        $route = $screen . '.show';
        $breadcrumbs->push(transb($route), '');
    }
}
if (!function_exists('breadcrumbIndex')) {

    /**
     * @param $breadcrumbs
     * @param $screen
     * @param null $parent
     * @param $allowLink
     * @param $params
     */
    function breadcrumbIndex($breadcrumbs, $screen, $parent = null, $allowLink = true, $params = [])
    {
        $route = $screen . '.index';
        $parent ? $breadcrumbs->parent($parent) : null;
        $breadcrumbs->push(transb($route), $allowLink ? route($route, $params) : null, ['allowLink' => $allowLink]);
    }
}

// migrate
if (!function_exists('getUpdatedAtColumn')) {

    function getUpdatedAtColumn($key = 'field')
    {
        return getSystemConfig('updated_at_column.' . $key);
    }
}
if (!function_exists('getCreatedAtColumn')) {

    function getCreatedAtColumn($key = 'field')
    {
        return getSystemConfig('created_at_column.' . $key);
    }
}
if (!function_exists('getDeletedAtColumn')) {

    function getDeletedAtColumn($key = 'field')
    {
        return getSystemConfig('deleted_at_column.' . $key, '');
    }
}

if (!function_exists('getDelFlagColumn')) {

    function getDelFlagColumn($key = 'field')
    {
        return getSystemConfig('del_flag_column.' . $key);
    }
}

if (!function_exists('getCreatedByColumn')) {

    function getCreatedByColumn($key = 'field')
    {
        return getSystemConfig('created_by_column.' . $key);
    }
}

if (!function_exists('getUpdatedByColumn')) {

    function getUpdatedByColumn($key = 'field')
    {
        return getSystemConfig('updated_by_column.' . $key);
    }
}

if (!function_exists('getDeletedByColumn')) {

    function getDeletedByColumn($key = 'field')
    {
        return getSystemConfig('deleted_by_column.' . $key, getUpdatedByColumn());
    }
}

if (!function_exists('getStatusColumn')) {

    function getStatusColumn($key = 'field')
    {
        return getSystemConfig('status_column.' . $key);
    }
}

// password
if (!function_exists('genPassword')) {

    function genPassword($value)
    {
        if ($value && Hash::needsRehash($value)) {
            return Hash::make($value);
        }
        return $value;
    }
}

if (!function_exists('isCollection')) {

    function isCollection($value)
    {
        return $value instanceof Illuminate\Support\Collection || $value instanceof Illuminate\Database\Eloquent\Collection;
    }
}

if (!function_exists('format')) {

    function format($date, $format = 'Y-m-d H:i:s')
    {
        try {
            if (!$date) {
                return $date;
            }
            return Carbon::createFromFormat('Y-m-d H:i:s', $date)->format($format);
        } catch (\Exception $e) {
            $date = date($format, strtotime($date));
        }
        return $date;
    }

}
if (!function_exists('formatPhone')) {

    function formatPhone($phone, $format = '$1-$2-$3')
    {
        $phone = preg_replace("/[^0-9]/", "", $phone);
        return preg_replace("/([0-9]{3})([0-9]{3})([0-9]{3,6})/", $format, $phone);
    }

}
if (!function_exists('formatZipCode')) {

    function formatZipCode($value, $format = '$1-$2')
    {
        $value = preg_replace("/[^0-9]/", "", $value);
        return preg_replace("/([0-9]{3})([0-9]{1,7})/", $format, $value);
    }

}

if (!function_exists('buildVersion')) {

    function buildVersion($file)
    {
        return $file . '?v=' . getSystemConfig('static_version');

    }
}

if (!function_exists('loadFile')) {

    function loadFiles($files, $area, $type = 'css')
    {
        if (empty($files)) {
            return '';
        }
        $result = '';
        foreach ($files as $item) {
            $filePath = $type . DIRECTORY_SEPARATOR . $area . DIRECTORY_SEPARATOR . $item . '.' . $type;
            if (!file_exists(public_path($filePath))) {
                continue;
            }
            $result .= $type == 'css' ? Html::style(buildVersion(public_url($filePath))) : Html::script(buildVersion(public_url($filePath)));
        }
        return $result;
    }
}

if (!function_exists('setLang')) {

    function setLang($lang = '')
    {
        $lang = $lang ? $lang : getCurrentLangCode();
        \App::setLocale($lang);
        \Illuminate\Support\Facades\Session::put(getLocaleKey(), $lang);
    }
}

if (!function_exists('array_filter_null')) {

    function array_filter_null($array)
    {
        foreach ($array as $key => $value) {
            if ($value === null || $value === '') {
                unset($array[$key]);
            }
        }
        return $array;
    }
}


if (!function_exists('toPhoneNumber')) {

    /**
     * @param $phone
     * @return mixed
     */
    function toPhoneNumber($phone)
    {
        return preg_replace(array('*-*', '*\s*', '*\(*', '*\)*'), '', $phone);
    }
}

if (!function_exists('getModelAttributes')) {

    /**
     * @param $alias
     * @return mixed
     */
    function getModelAttributes($alias)
    {
        return \Illuminate\Support\Facades\Lang::get('models.' . $alias . '.attributes');
    }
}

if (!function_exists('getModelCustomAttributes')) {

    /**
     * @param $alias
     * @return mixed
     */
    function getModelCustomAttributes($alias)
    {
        return \Illuminate\Support\Facades\Lang::get('models.' . $alias . '.custom_attributes');
    }
}
if (!function_exists('getModelAttribute')) {

    /**
     * @param $model
     * @param $attr
     * @return mixed
     */
    function getModelAttribute($model, $attr)
    {
        return \Illuminate\Support\Facades\Lang::get('models.' . $model . '.attributes.' . $attr);
    }
}
if (!function_exists('numberFormat')) {

    function numberFormat($number)
    {
        return !is_numeric($number) || empty($number) || '0' === (string)$number ? $number : number_format($number, 0, '.', ',');
    }
}
if (!function_exists('ebr')) {

    function ebr($html, $showWhiteSpace = false)
    {
        $string = nl2br(e($html));
        if (!$showWhiteSpace) {
            return $string;
        }
        $string = str_replace(' ', '&nbsp;', $string);
        return str_replace('　', '&nbsp;', $string);
    }
}
if (!function_exists('getAge')) {

    function getAge($birthday)
    {
        try {
            $birthday = Carbon::parse($birthday)->format('Y-m-d');
            list($year, $month, $day) = explode("-", $birthday);
            $yearDiff = date("Y") - $year;
            $monthDiff = date("m") - $month;
            $dayDiff = date("d") - $day;
            if ($monthDiff < 0) {
                $yearDiff--;
            } else if (($monthDiff == 0) && ($dayDiff < 0)) {
                $yearDiff--;
            }
            return $yearDiff;
        } catch (\Exception $exception) {

        }
        return 0;
    }
}
if (!function_exists('vietnameseToLatin')) {

    function vietnameseToLatin($string, $slug = '-')
    {
        $vietnamese = ["à", "á", "ạ", "ả", "ã", "â", "ầ", "ấ", "ậ", "ẩ", "ẫ", "ă", "ằ", "ắ", "ặ", "ẳ", "ẵ", "è", "é", "ẹ", "ẻ", "ẽ", "ê", "ề", "ế", "ệ", "ể", "ễ", "ì", "í", "ị", "ỉ", "ĩ", "ò", "ó", "ọ", "ỏ", "õ", "ô", "ồ", "ố", "ộ", "ổ", "ỗ", "ơ", "ờ", "ớ", "ợ", "ở", "ỡ", "ù", "ú", "ụ", "ủ", "ũ", "ư", "ừ", "ứ", "ự", "ử", "ữ", "ỳ", "ý", "ỵ", "ỷ", "ỹ", "đ", "À", "Á", "Ạ", "Ả", "Ã", "Â", "Ầ", "Ấ", "Ậ", "Ẩ", "Ẫ", "Ă", "Ằ", "Ắ", "Ặ", "Ẳ", "Ẵ", "È", "É", "Ẹ", "Ẻ", "Ẽ", "Ê", "Ề", "Ế", "Ệ", "Ể", "Ễ", "Ì", "Í", "Ị", "Ỉ", "Ĩ", "Ò", "Ó", "Ọ", "Ỏ", "Õ", "Ô", "Ồ", "Ố", "Ộ", "Ổ", "Ỗ", "Ơ", "Ờ", "Ớ", "Ợ", "Ở", "Ỡ", "Ù", "Ú", "Ụ", "Ủ", "Ũ", "Ư", "Ừ", "Ứ", "Ự", "Ử", "Ữ", "Ỳ", "Ý", "Ỵ", "Ỷ", "Ỹ", "Đ"];

        $latin = ["a", "a", "a", "a", "a", "a", "a", "a", "a", "a", "a", "a", "a", "a", "a", "a", "a", "e", "e", "e", "e", "e", "e", "e", "e", "e", "e", "e", "i", "i", "i", "i", "i", "o", "o", "o", "o", "o", "o", "o", "o", "o", "o", "o", "o", "o", "o", "o", "o", "o", "u", "u", "u", "u", "u", "u", "u", "u", "u", "u", "u", "y", "y", "y", "y", "y", "d", "A", "A", "A", "A", "A", "A", "A", "A", "A", "A", "A", "A", "A", "A", "A", "A", "A", "E", "E", "E", "E", "E", "E", "E", "E", "E", "E", "E", "I", "I", "I", "I", "I", "O", "O", "O", "O", "O", "O", "O", "O", "O", "O", "O", "O", "O", "O", "O", "O", "O", "U", "U", "U", "U", "U", "U", "U", "U", "U", "U", "U", "Y", "Y", "Y", "Y", "Y", "D"];

        $string = trim(str_replace($vietnamese, $latin, $string));
        $string = strtolower(str_replace(' ', $slug, $string));
        return preg_replace('/[^A-Za-z0-9\-\']/', '', $string);
    }
}
if (!function_exists('is_multi_array')) {

    function is_multi_array($arr)
    {
        rsort($arr);
        return isset($arr[0]) && is_array($arr[0]);
    }
}
if (!function_exists('sql_binding')) {

    function sql_binding($sql, $bindings)
    {
        $boundSql = str_replace(['%', '?'], ['%%', '%s'], $sql);
        foreach ($bindings as &$binding) {
            if ($binding instanceof \DateTime) {
                $binding = $binding->format('\'Y-m-d H:i:s\'');
            } elseif (is_string($binding)) {
                $binding = "'$binding'";
            }
        }
        $boundSql = vsprintf($boundSql, $bindings);
        return $boundSql;
    }
}
if (!function_exists('toSql')) {

    function toSql($query)
    {
        return sql_binding($query->toSql(), $query->getBindings());
    }
}
if (!function_exists('mysql_escape')) {
    function mysql_escape($inp)
    {
        if (is_array($inp)) return array_map(__METHOD__, $inp);

        if (!empty($inp) && is_string($inp)) {
            return str_replace(array('\\', "\0", "\n", "\r", "'", '"', "\x1a"), array('\\\\', '\\0', '\\n', '\\r', "\\'", '\\"', '\\Z'), $inp);
        }

        return $inp;
    }
}
if (!function_exists('breadcrumb_register')) {
    function breadcrumb_register($breadcrumbs, $parent = '', $reject = [])
    {
        foreach ($breadcrumbs as $breadcrumb) {
            if (in_array($breadcrumb['type'], $reject)) {
                continue;
            }
            if ($breadcrumb['type'] == 'resource') {
                build_resource_breadcrumbs($breadcrumb, $parent);
                continue;
            }
            $name = isset($breadcrumb['name']) ? $breadcrumb['name'] : $breadcrumb['screen'] . '.' . $breadcrumb['type'];
            call_user_func_array('Breadcrumbs::register', [$name, function ($bd) use ($breadcrumb, $parent) {
                $type = $breadcrumb['type'];
                switch ($type) {
                    case 'index' :
                        breadcrumbIndex($bd, $breadcrumb['screen'], $parent, isset($breadcrumb['allow_link']) ? $breadcrumb['allow_link'] : true, array_get($breadcrumb, 'params'));
                        break;
                    case 'edit' :
                        breadcrumbEdit($bd, $breadcrumb['screen']);
                        break;
                    case 'show' :
                        breadcrumbShow($bd, $breadcrumb['screen']);
                        break;
                    case 'create' :
                        breadcrumbCreate($bd, $breadcrumb['screen']);
                        break;
                    case 'confirm' :
                        breadcrumbConfirm($bd, $breadcrumb['screen']);
                        break;
                    case 'other' :
                        breadcrumbOther($bd, $breadcrumb['name'], $parent, isset($breadcrumb['allow_link']) ? $breadcrumb['allow_link'] : true, array_get($breadcrumb, 'params'));
                        break;
                }
            }]);
            if (isset($breadcrumb['childs'])) {
                breadcrumb_register($breadcrumb['childs'], $name);
            }
        }
    }
}
function build_resource_breadcrumbs($breadcrumb, $parent)
{
    if (array_get($breadcrumb, 'only', [])) {
        $newBreadcrumbs = [];
        foreach (array_get($breadcrumb, 'only', []) as $type) {
            $newBreadcrumbs[] = [
                'type' => $type,
                'screen' => $breadcrumb['screen'],
            ];
        }
    } else {
        $newBreadcrumbs = [
            [
                'type' => 'index',
                'screen' => $breadcrumb['screen'],
            ],
            [
                'type' => 'show',
                'screen' => $breadcrumb['screen'],
            ],
            [
                'type' => 'edit',
                'screen' => $breadcrumb['screen'],
            ],
            [
                'type' => 'create',
                'screen' => $breadcrumb['screen'],
            ],
            [
                'type' => 'confirm',
                'screen' => $breadcrumb['screen'],
            ],
        ];
    }
    breadcrumb_register($newBreadcrumbs, $parent, array_get($breadcrumb, 'reject', []));
}

if (!function_exists('randomString')) {
    function randomString($length = 10)
    {
        $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $charactersLength = strlen($characters);
        $randomString = '';
        for ($i = 0; $i < $length; $i++) {
            $randomString .= $characters[rand(0, $charactersLength - 1)];
        }
        return $randomString;
    }
}

if (!function_exists('isIndex')) {
    function isIndex()
    {
        if (App::runningInConsole()) {
            return false;
        }
        return request()->route()->getActionMethod() === 'index';
    }
}
if (!function_exists('isDestroy')) {
    function isDestroy()
    {
        if (App::runningInConsole()) {
            return false;
        }
        return request()->route()->getActionMethod() === 'destroy';
    }
}
if (!function_exists('isMassDestroy')) {
    function isMassDestroy()
    {
        if (App::runningInConsole()) {
            return false;
        }
        return request()->route()->getActionMethod() === 'massDestroy';
    }
}
if (!function_exists('isCreate')) {
    function isCreate()
    {
        if (App::runningInConsole()) {
            return false;
        }
        return request()->route()->getActionMethod() === 'create';
    }
}
if (!function_exists('isShow')) {
    function isShow()
    {
        if (App::runningInConsole()) {
            return false;
        }
        return request()->route()->getActionMethod() === 'show';
    }
}
if (!function_exists('isEdit')) {
    function isEdit()
    {
        if (App::runningInConsole()) {
            return false;
        }
        return request()->route()->getActionMethod() === 'edit';
    }
}
if (!function_exists('isValid')) {
    function isValid()
    {
        if (App::runningInConsole()) {
            return false;
        }
        return request()->route()->getActionMethod() === 'isValid';
    }
}
if (!function_exists('isConfirm')) {
    function isConfirm()
    {
        if (App::runningInConsole()) {
            return false;
        }
        return request()->route()->getActionMethod() === 'confirm';
    }
}
if (!function_exists('isUpdate')) {
    function isUpdate()
    {
        if (App::runningInConsole()) {
            return false;
        }
        return request()->route()->getActionMethod() === 'update';
    }
}
if (!function_exists('isStore')) {
    function isStore()
    {
        if (App::runningInConsole()) {
            return false;
        }
        return request()->route()->getActionMethod() === 'store';
    }
}
if (!function_exists('getViewData')) {
    function getViewData($key = null)
    {
        if (request()->route()) {
            return request()->route()->getController()->getViewData($key);
        }
        return null;
    }
}
if (!function_exists('public_url')) {
    function public_url($url)
    {
        if(strpos($url, 'http') !== false){
            return $url;
        }

        $appURL = config('app.url');
        $str = substr($appURL, strlen($appURL) - 1, 1);
        if ($str != '/') {
            $appURL .= '/';
        }
        if (\Illuminate\Support\Facades\Request::secure()) {
            $appURL = str_replace('http://', 'https://', $appURL);
        }
        return $appURL . 'public/' . $url;
    }
}
if (!function_exists('authRoutes')) {
    function authRoutes($area)
    {
        // Authentication Routes...
        Route::get('login', 'Auth\LoginController@showLoginForm')->name($area . '.login');
        Route::post('login', 'Auth\LoginController@login')->name($area . '.login');
        Route::middleware(['auth.' . $area])->post('logout', 'Auth\LoginController@logout')->name($area . '.logout');

        // Registration Routes...
        Route::get('register', 'Auth\RegisterController@showRegistrationForm')->name($area . '.register');
        Route::post('register', 'Auth\RegisterController@register')->name($area . '.register');

        // Password Reset Routes...
        Route::get('password/reset', 'Auth\ForgotPasswordController@showLinkRequestForm')->name($area . '.password.request');
        Route::post('password/email', 'Auth\ForgotPasswordController@sendResetLinkEmail')->name($area . '.password.email');
        if ($area === 'frontend'){
            Route::get('password/reset/{token}', 'HomeController@showResetPasswordDialog')->name($area . '.password.reset'); // custom
        }else{
            Route::get('password/reset/{token}', 'Auth\ResetPasswordController@showResetForm')->name($area . '.password.reset');
        }
        Route::post('password/reset', 'Auth\ResetPasswordController@reset')->name($area . '.password.reset');
    }
}

if (!function_exists('isBackend')) {
    function isBackend()
    {
        $uri = explode('/', request()->getRequestUri());
        return $uri[1] === getBackendAlias() || request()->getBaseUrl() === getBackendDomain();
    }
}

if (!function_exists('isApi')) {
    function isApi()
    {
        $uri = explode('/', request()->getRequestUri());
        return $uri[1] === getApiAlias() || request()->getBaseUrl() === getApiDomain();
    }
}


if (!function_exists('getCurrentArea')) {
    function getCurrentArea()
    {
        if (\Illuminate\Support\Facades\App::runningInConsole()) {
            return 'batch';
        }
        if (isBackend()) {
            return 'backend';
        }
        if (isApi()) {
            return 'api';
        }
        return 'frontend';
    }
}
if (!function_exists('getCurrentControllerName')) {
    function getCurrentControllerName()
    {
        return getViewData('controllerName');
    }
}
if (!function_exists('getCurrentAction')) {
    function getCurrentAction()
    {
        return getViewData('actionName');
    }
}
if (!function_exists('getBodyClass')) {
    function getBodyClass()
    {
        return 'app area-' . getCurrentArea() . ' c-' . getCurrentControllerName() . ' a-' . getCurrentAction() . ' l-' . getCurrentLangCode();
    }
}
if (!function_exists('addParamToUrl')) {
    function addParamToUrl($url, $varName, $value = null)
    {
        if (is_array($varName)) {
            $value = http_build_query($varName);
        } else {
            $value = $varName . "=" . $value;
        }
        // is there already an ?
        if (strpos($url, "?")) {
            $url .= "&" . $value;
        } else {
            $url .= "?" . $value;
        }
        return $url;
    }
}

if (!function_exists('escape')) {
    /**
     * Escape HTML special characters in a string and allow new line.
     *
     * @param  \Illuminate\Contracts\Support\Htmlable|string  $value
     * @param bool $is_xhtml [optional]
     * @return string
     */
    function escape($value, $is_xhtml = null)
    {
        return nl2br(e($value), $is_xhtml);
    }
}

if (!function_exists('isVideo')) {
    /**
     * @param string  $url
     * @param array  $extensionVideos
     * @return boolean
     */
    function isVideo($url, $extensionVideos = [])
    {
        $extensionVideos = empty($extensionVideos) ? getConfig('file.default.video.ext') : $extensionVideos;
        $extension = preg_replace('/.*\.(\w+$)/', '$1', $url);
        if (collect($extensionVideos)->contains(strtolower($extension))) { // is video
            return true;
        } else { // is not video
            return false;
        }
    }
}

if (!function_exists('isAdmin')) {
    /**
     * @return mixed
     */
    function isAdmin()
    {
        return backendGuard()->user()->isAdmin();
    }
}

if (!function_exists('isRoleStore')) {
    /**
     * @return mixed
     */
    function isRoleStore()
    {
        return backendGuard()->user()->isStore();
    }
}

if (!function_exists('isView')) {
    /**
     * @return mixed
     */
    function isView()
    {
        return backendGuard()->user()->isView();
    }
}

if (!function_exists('getRoleConfig')) {
    function getRoleConfig()
    {
        $type = backendGuard()->user()->role_type;
        $roles = getConfig('user.role_type');
        if (isAdmin()) {
            return $roles;
        }
        return [$type => array_get($roles, $type)];
    }
}

/**
 * @return boolean
 */
if (!function_exists('getModelFromTable')) {
    function getModelFromTable($table)
    {
        $scopes = \App\Model\Base\Base::getAllGlobalScope();
        foreach ($scopes as $scope) {
            foreach ($scope as $value) {
                $model = $value->getModel();
                if ($model->getTable() == $table) {
                    return $model;
                }
            }
        }
        return false;
    }
}

if (!function_exists('isBase64Img')) {
    function isBase64Img($str)
    {
        $imageParts = explode(";base64,", $str);
        $str = array_get($imageParts, 1, $str);

        if (base64_encode(base64_decode($str, true)) === $str) {
            return true;
        } else {
            return false;
        }
    }
}

if (!function_exists('isMobile')) {
    function isMobile()
    {
        if(array_key_exists('HTTP_USER_AGENT', $_SERVER)) {
            $userAgent = $_SERVER['HTTP_USER_AGENT'];
            return preg_match('/(android|bb\d+|meego).+mobile|avantgo|bada\/|blackberry|blazer|compal|elaine|fennec|hiptop|iemobile|ip(hone|od)|iris|kindle|lge |maemo|midp|mmp|netfront|opera m(ob|in)i|palm( os)?|phone|p(ixi|re)\/|plucker|pocket|psp|series(4|6)0|symbian|treo|up\.(browser|link)|vodafone|wap|windows (ce|phone)|xda|xiino/i', $userAgent) || preg_match('/1207|6310|6590|3gso|4thp|50[1-6]i|770s|802s|a wa|abac|ac(er|oo|s\-)|ai(ko|rn)|al(av|ca|co)|amoi|an(ex|ny|yw)|aptu|ar(ch|go)|as(te|us)|attw|au(di|\-m|r |s )|avan|be(ck|ll|nq)|bi(lb|rd)|bl(ac|az)|br(e|v)w|bumb|bw\-(n|u)|c55\/|capi|ccwa|cdm\-|cell|chtm|cldc|cmd\-|co(mp|nd)|craw|da(it|ll|ng)|dbte|dc\-s|devi|dica|dmob|do(c|p)o|ds(12|\-d)|el(49|ai)|em(l2|ul)|er(ic|k0)|esl8|ez([4-7]0|os|wa|ze)|fetc|fly(\-|_)|g1 u|g560|gene|gf\-5|g\-mo|go(\.w|od)|gr(ad|un)|haie|hcit|hd\-(m|p|t)|hei\-|hi(pt|ta)|hp( i|ip)|hs\-c|ht(c(\-| |_|a|g|p|s|t)|tp)|hu(aw|tc)|i\-(20|go|ma)|i230|iac( |\-|\/)|ibro|idea|ig01|ikom|im1k|inno|ipaq|iris|ja(t|v)a|jbro|jemu|jigs|kddi|keji|kgt( |\/)|klon|kpt |kwc\-|kyo(c|k)|le(no|xi)|lg( g|\/(k|l|u)|50|54|\-[a-w])|libw|lynx|m1\-w|m3ga|m50\/|ma(te|ui|xo)|mc(01|21|ca)|m\-cr|me(rc|ri)|mi(o8|oa|ts)|mmef|mo(01|02|bi|de|do|t(\-| |o|v)|zz)|mt(50|p1|v )|mwbp|mywa|n10[0-2]|n20[2-3]|n30(0|2)|n50(0|2|5)|n7(0(0|1)|10)|ne((c|m)\-|on|tf|wf|wg|wt)|nok(6|i)|nzph|o2im|op(ti|wv)|oran|owg1|p800|pan(a|d|t)|pdxg|pg(13|\-([1-8]|c))|phil|pire|pl(ay|uc)|pn\-2|po(ck|rt|se)|prox|psio|pt\-g|qa\-a|qc(07|12|21|32|60|\-[2-7]|i\-)|qtek|r380|r600|raks|rim9|ro(ve|zo)|s55\/|sa(ge|ma|mm|ms|ny|va)|sc(01|h\-|oo|p\-)|sdk\/|se(c(\-|0|1)|47|mc|nd|ri)|sgh\-|shar|sie(\-|m)|sk\-0|sl(45|id)|sm(al|ar|b3|it|t5)|so(ft|ny)|sp(01|h\-|v\-|v )|sy(01|mb)|t2(18|50)|t6(00|10|18)|ta(gt|lk)|tcl\-|tdg\-|tel(i|m)|tim\-|t\-mo|to(pl|sh)|ts(70|m\-|m3|m5)|tx\-9|up(\.b|g1|si)|utst|v400|v750|veri|vi(rg|te)|vk(40|5[0-3]|\-v)|vm40|voda|vulc|vx(52|53|60|61|70|80|81|83|85|98)|w3c(\-| )|webc|whit|wi(g |nc|nw)|wmlb|wonu|x700|yas\-|your|zeto|zte\-/i', substr($userAgent, 0, 4));
        }
        return false;
    }
}

/**
 * @param App\Repositories\Base\CustomRepository $obj
 * @return string
 */
if (!function_exists('getShortClassName')) {
    function getShortClassName($obj)
    {
        return (new \ReflectionClass($obj))->getShortName();
    }
}
/**
 * @param App\Repositories\Base\CustomRepository $obj
 * @return string
 */
if (!function_exists('getTextWithFormat')) {
    function getTextWithFormat($text, $text2, $format)
    {
        if ($text && $text2) {
            return $text . $format . $text2;
        }
        if ($text && !$text2) {
            return $text;
        }
        if (!$text && $text2) {
            return $text2;
        }
        return '';
    }
}

/**
 * @return boolean
 */
if (!function_exists('isDebug')) {
    function isDebug()
    {
        return config('app.debug');
    }
}

/**
 * @return boolean
 */
if (!function_exists('rjust')) {
    function rjust($string, $totalLength, $fillChar = ' ')
    {
        // if the string is longer than the total length allowed just return it
        if (strlen($string) >= $totalLength) {
            return $string;
        }

        $totalLength = intval($totalLength);

        // total_length must be a number greater than 0
        if (!$totalLength) {
            return $string;
        }

        // the $fillchar can't be empty
        if (!strlen($fillChar)) {
            return $string;
        }

        // make the fill character into padding
        while (strlen($fillChar) < $totalLength) {
            $fillChar = $fillChar . $fillChar;
        }


        return substr($fillChar . $string, (-1 * $totalLength));

    }
}


if (!function_exists('isController')) {
    function isController($controllerName)
    {
        return getCurrentControllerName() == $controllerName;
    }
}
if (!function_exists('isAction')) {
    function isAction($actionName)
    {
        return getCurrentAction() == $actionName;
    }
}

if (!function_exists('getNavActiveClass')) {
    function getNavActiveClass($controllerName, $actionName = '')
    {
        if(empty($actionName)){
            return isController($controllerName) ? ' active' : '';
        }
        return isController($controllerName) && isAction($actionName) ? ' active' : '';
    }
}

if (!function_exists('transMessages')) {
    function transMessages($key, $replace = [])
    {
        return trans("messages.$key", $replace);
    }
}

/**
 * @return boolean
 */
if (!function_exists('rjust')) {
    function rjust($string, $totalLength, $fillChar = ' ')
    {
        // if the string is longer than the total length allowed just return it
        if (strlen($string) >= $totalLength) {
            return $string;
        }

        $totalLength = intval($totalLength);

        // total_length must be a number greater than 0
        if (!$totalLength) {
            return $string;
        }

        // the $fillchar can't be empty
        if (!strlen($fillChar)) {
            return $string;
        }

        // make the fill character into padding
        while (strlen($fillChar) < $totalLength) {
            $fillChar = $fillChar . $fillChar;
        }


        return substr($fillChar . $string, (-1 * $totalLength));

    }
}

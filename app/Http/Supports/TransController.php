<?php

namespace App\Http\Supports;

use App\Http\Controllers\Base\FrontendController;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Lang;

class TransController extends FrontendController
{
    public function switchLang($lang)
    {
        setLang($lang);
        return redirect()->back();
    }

    public function updateLang()
    {
        $source = Input::get('source');
        $value = Input::get('val');
        if (!$source || !$value) {
            $this->setMessage(trans('messages.failed'));
            return $this->renderErrorJson();
        }
        $sourceArr = explode('.', $source);

        $currentLang = getCurrentLangCode();
        $file = array_first($sourceArr);
        $oldValue = Lang::get($file);
        unset($sourceArr[0]);
        $sourceArr = implode('.', $sourceArr);
        array_set($oldValue, $sourceArr, $value);
        $file = $_SERVER['DOCUMENT_ROOT'] . DIRECTORY_SEPARATOR . 'resources' . DIRECTORY_SEPARATOR . 'lang' . DIRECTORY_SEPARATOR . $currentLang . DIRECTORY_SEPARATOR . $file . '.php';
        file_put_contents($file, ' <?php return ' . var_export($oldValue, true) . ';');
        return $this->renderJson();
    }
}

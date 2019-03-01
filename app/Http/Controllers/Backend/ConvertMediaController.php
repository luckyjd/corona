<?php

namespace App\Http\Controllers\Backend;

use App\Helpers\Facades\CustomStorage;
use App\Http\Controllers\Base\BackendController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;

/**
 * Class ConvertMediaController
 * @package App\Http\Controllers\Backend
 */
class ConvertMediaController extends BackendController
{
    public function convert(Request $request)
    {
        try {
            $fromType = Input::get('from_type', 'mov');
            $toType = Input::get('to_type', 'mp4');
            $value = $request->file('filename');
            $isBase64 = false;
            if (empty($value) || is_scalar($value)) {
                $isBase64 = isBase64Img($value);
            }
            $unique = hash('sha1', uniqid(time(), true));
            $fileName = $unique . '.' . ($isBase64 ? $fromType : strtolower($value->getClientOriginalExtension()));
            $fileName = strtolower($fileName);
            $fileName = CustomStorage::uploadToTmp($fileName, $value);
            $newFilename = str_replace($fromType, $toType, $fileName);
            // convert
            $oldFilePath = public_path($fileName);
            $newFilePath = public_path($newFilename);
            exec('ffmpeg -i ' . $oldFilePath . ' -c copy ' . $newFilePath);
            @unlink(public_path($fileName));
            return $this->renderJson([
                'data'=>[
                    'file_url' => public_url($newFilename),
                    'file_path' => $newFilename
                ]
            ]);
        } catch (\Exception $exception) {
            logError($exception);
        }
        $this->setMessage(trans('messages.failed'));
        return $this->renderErrorJson();
    }

    public function saveCropImgTmpFile()
    {
        try {
            $value = Input::get('filename');
            if(empty($value)){
                $this->setMessage(trans('messages.failed'));
                return $this->renderErrorJson();
            }
            $isBase64 = false;
            if (empty($value) || is_scalar($value)) {
                $isBase64 = isBase64Img($value);
            }
            $unique = hash('sha1', uniqid(time(), true));
            $fileName = $unique . '.' . ($isBase64 ? 'png' : strtolower($value->getClientOriginalExtension()));
            $fileName = strtolower($fileName);
            $fileName = CustomStorage::uploadToTmp($fileName, $value);
            // convert
            return $this->renderJson([
                'data'=>[
                    'file_url' => public_url($fileName),
                    'file_path' => $fileName
                ]
            ]);
        } catch (\Exception $exception) {
            logError($exception);
        }
        $this->setMessage(trans('messages.failed'));
        return $this->renderErrorJson();
    }
}

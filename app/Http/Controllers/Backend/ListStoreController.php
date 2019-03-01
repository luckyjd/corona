<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Base\BackendController;
use App\Repositories\ShopRepository;
use App\Repositories\UserRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

/**
 * Class CustomerController
 * @package App\Http\Controllers\Backend
 */
class ListStoreController extends BackendController
{
    /**
     * CustomerController constructor.
     * @param UserRepository $userRepository
     */
    public function __construct(ShopRepository $shopRepository)
    {
        parent::__construct();
        $this->setRepository($shopRepository);
        $this->setBackUrlDefault('shop.index');
    }

    public function importExcel(Request $request)
    {
        if (!$request->hasFile('import_file')) {
            return $this->_backToStart()->withErrors(trans('messages.create_failed'));
        }
        $header = null;
        $data = [];
        $codes = [];
        $i = 0;
        if (($handle = fopen($request->file('import_file')->getRealPath(), 'r')) !== false) {
            while (($row = fgetcsv($handle, 1000, ',')) !== false) {
                if ($i == 0) {
                    if (count($row) != getConstant('COUNT_COLUMN_SHOP_CSV')) {
                        return $result = $this->_back()->withErrors(trans('messages.upload_csv_again'))->withInput();
                    }
                    $i++;
                    continue;
                }
                $code = array_get($row, 0);
                if (!$code) {
                    continue;
                }
                $codes[] = $code;
                $data[$code] = [
                    'code' => $code,
                    'tel' => array_get($row, 1),
                    'name' => array_get($row, 2),
                    'zip_code' => array_get($row, 3),
                    'pref' => array_get($row, 4),
                    'address' => array_get($row, 5),
                    'address1' => array_get($row, 6),
                    'address2' => array_get($row, 7),
                    'address3' => array_get($row, 8),
                ];
            }
            fclose($handle);
        }
        $updateList = $this->getRepository()->withTrashed()->whereIn('code', $codes)->get();
        $validator = $this->getRepository()->getValidator();
        DB::beginTransaction();
        try {
            foreach ($updateList as $value) {
                if (!$validator->validateCsv($value->toArray())) {
                    return $result = $this->_back()->withErrors(['inValid' => $validator->errors()])->withInput();
                }
                $code = $value->code;
                if (array_has($data, $code)) {
                    $value->fill($data[$code])->save();
                    unset($data[$code]);
                }
            }

            foreach ($data as $datum) {
                if (!$validator->validateCsv($datum)) {
                    return $result = $this->_back()->withErrors(['inValid' => $validator->errors()])->withInput();
                }
                $datum['ins_datetime'] = date('Y-m-d H:i:s');
                $this->getRepository()->insert($datum);
            }
            DB::commit();
            return $this->_backToStart()->withSuccess(trans('messages.create_success'));
        } catch (\Exception $e) {
            logError($e);
            $this->_removeMediaFile(isset($entity) ? $entity : null);
            DB::rollBack();
        }
        return $this->_backToStart()->withErrors(trans('messages.create_failed'));
    }
}
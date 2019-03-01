<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Base\BackendController;
use App\Model\Entities\Application;
use App\Model\Entities\Present;
use App\Model\Entities\Shipping;
use App\Repositories\ShippingRepository;
use App\Repositories\UserRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Model\Entities\User;
use Illuminate\Support\Facades\Response;

/**
 * Class CustomerController
 * @package App\Http\Controllers\Backend
 */
class ShippingController extends BackendController
{
    /**
     * CustomerController constructor.
     * @param UserRepository $userRepository
     */
    public function __construct(ShippingRepository $shippingRepository)
    {
        parent::__construct();
        $this->setRepository($shippingRepository);
        $this->setBackUrlDefault('shipping.index');
    }

    public function exportCsv()
    {
        try {
            ini_set('memory_limit', '1024M');
            ini_set('max_execution_time ', 9999999);
            $sql = toSql(DB::table($this->getRepository()->getTable())
                ->select([
                    DB::raw(Shipping::getQuaColumn('application_id') . ' as application_id'),
                    DB::raw(Shipping::getQuaColumn('first_name') . ' as user_first_name'),
                    DB::raw(Shipping::getQuaColumn('id') . ' as shipping_id'),
                    DB::raw(Shipping::getQuaColumn('last_name') . ' as user_last_name'),
                    DB::raw(Shipping::getQuaColumn('email') . ' as user_email'),
                    DB::raw(Shipping::getQuaColumn('address') . ' as address'),
                    DB::raw(Shipping::getQuaColumn('address1') . ' as address1'),
                    DB::raw(Shipping::getQuaColumn('zip_code') . ' as zip_code'),
                    DB::raw(Shipping::getQuaColumn('tel') . ' as tel'),
                    DB::raw(Shipping::getQuaColumn('pref_id') . ' as pref_id'),
                    DB::raw(Shipping::getQuaColumn('store_list') . ' as store_list'),
                    DB::raw(Shipping::getQuaColumn('shipping_flg') . ' as shipping_flg'),
                    DB::raw(Present::getQuaColumn('name') . ' as shipping_present'),
                ])
                ->leftJoin(Application::getTableName(), Application::getQuaColumn('id'), Shipping::getQuaColumn('application_id'))
                ->join(Present::getTableName(), Application::getQuaColumn('present_id'), Present::getQuaColumn('id'))
                ->whereNull('shipping_flg')->orWhere('shipping_flg', 0));
            $result = DB::getPdo()->query($sql);
            // export
            $filename = 'shipping' . '_' . date('Ymd') . '.csv';
            $fp = fopen('php://temp', 'r+b');
            fputs($fp, "\xEF\xBB\xBF"); // UTF-8 BOM !!!!!
            $headerFields = [
                '応募ID',
                '名前',
                'ユーザメールアドレス',
                '住所',
                '当選商品名',
                '電話番号',
                '発送フラグ'
            ];
            fputcsv($fp, $headerFields);
            while ($row = $result->fetch(\PDO::FETCH_ASSOC)) {
                fputcsv($fp, [
                    $row['application_id'],
                    $row['user_last_name'] . ' ' . $row['user_first_name'],
                    $row['user_email'],
                    '〒' . $row['zip_code'] . ' ' . getConfig('prefs.' . $row['pref_id']) . ' ' . $row['address'],
                    $row['shipping_present'],
                    $row['tel'] ? '\'' . $row['tel'] : '',
                    getConfig('shipping.shipping_flg.' . $row['shipping_flg'])
                ]);
            }
            rewind($fp);
            $headers = array(
                'Content-Type' => 'text/csv',
                'Content-Disposition' => 'attachment; filename="' . $filename . '"',
            );
            return Response::make(stream_get_contents($fp), 200, $headers);
        } catch (\Exception $e) {
            logError($e->getMessage());
            return $this->_backToStart()->withErrors(trans('messages.failed'));
        }
    }

    public function exportCsvCongrat()
    {
        try {
            ini_set('memory_limit', '1024M');
            ini_set('max_execution_time ', 9999999);
            $sql = toSql(DB::table($this->getRepository()->getTable())
                ->select([
                    DB::raw('application_id', 'status'),
                    DB::raw(Shipping::getQuaColumn('id') . ' as shipping_id'),
                    DB::raw(Shipping::getQuaColumn('first_name') . ' as user_first_name'),
                    DB::raw(Shipping::getQuaColumn('last_name') . ' as user_last_name'),
                    DB::raw(Shipping::getQuaColumn('email') . ' as user_email'),
                    DB::raw(Shipping::getQuaColumn('address') . ' as address'),
                    DB::raw(Shipping::getQuaColumn('address1') . ' as address1'),
                    DB::raw(Shipping::getQuaColumn('zip_code') . ' as zip_code'),
                    DB::raw(Shipping::getQuaColumn('tel') . ' as tel'),
                    DB::raw(Shipping::getQuaColumn('pref_id') . ' as pref_id'),
                    DB::raw(Application::getQuaColumn('id') . ' as user_application_id'),
                    DB::raw(Application::getQuaColumn('status') . ' as user_application_status'),
                    DB::raw(Shipping::getQuaColumn('store_list') . ' as store_list'),
                    DB::raw(Shipping::getQuaColumn('shipping_flg') . ' as shipping_flg'),
                    DB::raw(Present::getQuaColumn('name') . ' as shipping_present'),
                ])
                ->leftJoin(Application::getTableName(), Application::getQuaColumn('id'), Shipping::getQuaColumn('application_id'))
                ->join(Present::getTableName(), Application::getQuaColumn('present_id'), Present::getQuaColumn('id'))
                ->where(Application::getQuaColumn('status'), 1)
                ->orderBy(Application::getQuaColumn('id'), 'DESC'));
            $result = DB::getPdo()->query($sql);
            // export
            $filename = 'application' . '_' . date('Ymd') . '.csv';
            $fp = fopen('php://temp', 'r+b');
            fputs($fp, "\xEF\xBB\xBF"); // UTF-8 BOM !!!!!
            $headerFields = [
                '応募ID',
                '名前',
                'ユーザメールアドレス',
                '住所',
                '当選商品名',
                '電話番号',
                '発送フラグ'
            ];
            fputcsv($fp, $headerFields);
            while ($row = $result->fetch(\PDO::FETCH_ASSOC)) {
                fputcsv($fp, [
                    $row['user_application_id'],
                    $row['user_last_name'] . ' ' . $row['user_first_name'],
                    $row['user_email'],
                    '〒' . $row['zip_code'] . ' ' . getConfig('prefs.' . $row['pref_id']) . ' ' . $row['address'],
                    $row['shipping_present'],
                    $row['tel'] ? '\'' . $row['tel'] : '',
                    getConfig('shipping.shipping_flg.' . $row['shipping_flg'])
                ]);
            }
            rewind($fp);
            $headers = array(
                'Content-Type' => 'text/csv',
                'Content-Disposition' => 'attachment; filename="' . $filename . '"',
            );
            return Response::make(stream_get_contents($fp), 200, $headers);
        } catch (\Exception $e) {
            logError($e->getMessage());
            return $this->_backToStart()->withErrors(trans('messages.failed'));
        }
    }

    public function importExcel(Request $request)
    {
        if (!$request->hasFile('import_file')) {
            return $this->_backToStart()->withErrors(trans('messages.create_failed'));
        }
        $header = null;
        $data = $shippings = $fields = [];
        $i = 0;
        if (($handle = fopen($request->file('import_file')->getRealPath(), 'r')) !== false) {
            while (($row = fgetcsv($handle, 1000, ',')) !== false) {
                if ($i == 0) {
                    $i++;
                    continue;
                }
                $applicationId = array_get($row, 0);
                if (!$applicationId) {
                    continue;
                }
                if (count($row) != getConstant('COUNT_COLUMN_SHIPPING_CSV')) {
                    return $result = $this->_back()->withErrors(trans('messages.upload_csv_again'))->withInput();
                }
                $shippings[] = $applicationId;
                $data[$applicationId] = [
                    'application_id' => $applicationId,
                    'first_name' => array_get($row, 1),
                    'email' => array_get($row, 2),
                    'address' => array_get($row, 3),
                    'store_list' => array_get($row, 4),
                    'tel' => array_get($row, 5),
                    'shipping_flg' => array_get($row, 6),
                ];
            }
            fclose($handle);
        }
        DB::beginTransaction();
        try {
            $shippingConfig = getConfig('shipping.shipping_flg');
            $shippingConfig = array_flip($shippingConfig);
            $shippingFlgChange = 0;
            foreach ($data as $item) {
                $entity = $this->getRepository()->getModel()->where('application_id', $item['application_id'])->first();
                if (!empty($entity)) {
                    if (!array_key_exists($item['shipping_flg'], $shippingConfig)) {
                        continue;
                    }
                    if ($entity->shipping_flg != $shippingConfig[$item['shipping_flg']]) {
                        $entity->shipping_flg = $shippingConfig[$item['shipping_flg']];
                        $shippingFlgChange += 1;
                    }
                    $entity->save();
                }
            }
            DB::commit();
            return $this->_backToStart()->withSuccess($shippingFlgChange . trans('messages.upload_csv_success'));
        } catch (\Exception $e) {
            logError($e);
            DB::rollBack();
        }
        return $this->_backToStart()->withErrors(trans('messages.create_failed'));
    }

}
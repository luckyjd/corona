<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Base\BackendController;
use App\Model\Entities\SerialNumber;
use App\Repositories\SerialNumberRepository;
use App\Services\SerialNumberService;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Response;

class SerialNumbersController extends BackendController
{
    protected $_service = null;

    public function getService()
    {
        return $this->_service;
    }

    public function setService($service)
    {
        $this->_service = $service;
    }

    public function __construct(SerialNumberRepository $serialNumberRepository, SerialNumberService $serialNumberService)
    {
        parent::__construct();
        $this->setRepository($serialNumberRepository);
        $this->setService($serialNumberService);
        $this->setBackUrlDefault('serial_numbers.index');
    }

    public function store()
    {
        ini_set('memory_limit','1024M');
        // Get quantity in form
        $quantity = Input::get('quantity');

        if ($quantity <= 0) {
            return $this->_backToStart()->withErrors(trans('messages.create_failed'));
        }

        $maxQuantity = getConstant('MAX_QUANTITY');
        $currentQuantity = $this->getRepository()->count();

        if ($quantity + $currentQuantity > $maxQuantity) {
            $quantity = $maxQuantity - $currentQuantity;
        }

        $isInsert = $this->getService()->save($quantity);

        if ($isInsert) {
            return $this->_backToStart()->withSuccess(trans('messages.create_success'));
        }

        return $this->_backToStart()->withErrors(trans('messages.create_failed'));
    }

    public function exportCsv()
    {
        try {
            $count = $this->getRepository()->count();
            if(!serialIsLimited($count)){
                return $this->_backToStart()->withErrors(trans('messages.failed'));
            }
            ini_set('memory_limit', '1024M');
            ini_set('max_execution_time ', 9999999);
            $sql = toSql(DB::table($this->getRepository()->getTable())->select([DB::raw('id,serial_number'), DB::raw(SerialNumber::getQuaColumn('key'))])
                ->where(getDelFlagColumn(), getDelFlagColumn('active'))->whereNull('user_id'));
            $result = DB::getPdo()->query($sql);
            // export
            $filename = getConfig('csv.export.' . $this->getCurrentControllerName() . '.filename_prefix') . '_' . date('Ymd') . '.csv';
            $fp = fopen('php://temp', 'r+b');
            $url = getConstant('CSV_SERIAL_URL');
            while ($row = $result->fetch(\PDO::FETCH_ASSOC)) {
                fputcsv($fp, ['url' => getApplicationGameUrl($url, $row['serial_number'], $row['key'])]);
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
}
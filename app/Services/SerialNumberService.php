<?php

namespace App\Services;

use App\Repositories\PresentRepository;
use App\Repositories\SerialNumberRepository;
use App\Services\Base\BaseService;
use Illuminate\Support\Facades\DB;

class SerialNumberService extends BaseService
{
    protected $_presentRepository = null;

    /**
     * @return null
     */
    public function getPresentRepository()
    {
        return $this->_presentRepository;
    }

    /**
     * @param null $presentRepository
     */
    public function setPresentRepository($presentRepository)
    {
        $this->_presentRepository = $presentRepository;
    }

    public function __construct(SerialNumberRepository $serialNumberRepository, PresentRepository $presentRepository)
    {
        $this->setRepository($serialNumberRepository);
        $this->setPresentRepository($presentRepository);
    }

    public function save($quantity)
    {
        $max = getConfig('quantities');
        // 1 time insert $max serial number, $max = first of array quantities
        $max = array_keys($max)[0];
        $times = (int) ceil($quantity / $max);
        $maxSerial = $this->getRepository()->select(DB::raw('id, max(serial_number) max_serial_number'))->first();
        $maxSerial = (int)$maxSerial->max_serial_number;
        if ($times < 2) {
            return DB::insert($this->_getSql($quantity, $maxSerial));
        }

        DB::beginTransaction();
        try {
            for ($i = 0; $i < $times; $i ++) {
                $maxQuantity = getConstant('MAX_QUANTITY');

                if ($max + $maxSerial > $maxQuantity) {
                    $max = $maxQuantity - $maxSerial;
                }
                if($max == 0){
                    continue;
                }
                DB::insert($this->_getSql($max, $maxSerial));
            }
            DB::commit();
            return true;
        } catch (\Exception $e) {
            logError($e);
            DB::rollBack();
        }
        return false;
    }

    protected function _genKey($serialNumber, $salt)
    {
        return $this->getRepository()->genKey($serialNumber, $salt);
    }

    protected function _getSql($max, &$maxSerial)
    {
        $salt = getConstant('SERIAL_NUMBER_SALT');
        $query = 'INSERT INTO ' . $this->getRepository()->getTable() . ' (`serial_number`, `key`, `ins_id`) VALUES ';
        $idAdmin = getCurrentUserId();

        // Get value
        for ($i = 0; $i < $max; $i ++) {
            $maxSerial++;
            $serialNumber = $this->getRepository()->genSerialNumber($maxSerial);
            $key = $this->_genKey($serialNumber, $salt);
            $query .= '("' . $serialNumber . '", "' . $key . '",' . $idAdmin . '), ';
        }

        // Make true query
        $query = rtrim($query, ', ');
        return $query;
    }

    public function genWinners()
    {
//        $presents =
    }
}
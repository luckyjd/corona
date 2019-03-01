<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Base\BackendController;
use App\Model\Base\Dynamic;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Input;
use Maatwebsite\Excel\Facades\Excel;
use Symfony\Component\HttpFoundation\Request;

/**
 * Class DashboardController
 * @package App\Http\Controllers\Backend
 */
class PlImportController extends BackendController
{
    public function index()
    {
        return $this->render();
    }

    /**
     * @param Request $request
     */
    public function import(Request $request)
    {
        if ($request->hasFile('file_excel')) {
            Excel::load(Input::file('file_excel'), function ($reader) {
                $this->_processExcel($reader);
            });
        }

        return $this->render('backend.pl_import.display');
    }

    /**
     * @param $reader
     */
    protected function _processExcel($reader)
    {
        $sheets = $reader->getAllSheets();
        $data = [];
        $ignoreFields = ['del_flag', 'ins_datetime', 'ins_id', 'upd_datetime', 'upd_id'];

        foreach (array_slice($sheets, 2) as $sheet) {
            $sheetTitle = $sheet->getTitle();
            $table = [];

            foreach ($sheet->toArray() as $index => $item) {
                if ($index == 6) {
                    $table['title'] = $item[12];
                }
                if (in_array($item[11], $ignoreFields)) {
                    continue;
                }

                if ($index > 9 and !empty($item[2])) {
                    if ($item[2] == 'ID') {
                        $table['attr'][] = '$table->increments("id");';
                        continue;
                    }

                    $type = $this->_detectType($item[20]);
                    $null = $this->_detectNull($item[27]);
                    $length = $this->_detectLength($type, $item[23]);
                    $default = $this->_detectDefault($item[33]);

                    $table['attr'][] = '$table->' . $type . '(\'' . $item[11] . '\'' . $length . ')' . $null . $default . '->comment(\'' . $item[2] . '\');';
                }
            }
            $data[] = $table;
        }

        $this->setViewData(['data' => $data]);
    }

    protected function _detectType($typeString)
    {
        $type = '';
        switch ($typeString) {
            case 'SMALLINT':
                $type = 'smallInteger';
                break;
            case 'INTEGER':
                $type = 'integer';
                break;
            case 'VARCHAR':
                $type = 'string';
                break;
            case 'CHAR':
                $type = 'char';
                break;
            case 'GEOMETRY':
                $type = 'geometry';
                break;
            case 'TEXT':
                $type = 'text';
                break;
            default:
                break;
        }

        return $type;
    }

    protected function _detectNull($nullString)
    {
        return $nullString == 'Y' ? '->nullable()' : '';
    }

    protected function _detectLength($type, $length)
    {
        $lengthString = '';

        if ($type == 'text'
            || $type == 'smallInteger'
            || $type == 'geometry'
        ) {
            return $lengthString;
        }

        $lengthString = ', ' . $length;

        return $lengthString;
    }

    protected function _detectDefault($defaultValue)
    {
        return !empty($defaultValue) ? '->default(' . $defaultValue . ')' : '';
    }

    public function getTableColumns($table)
    {
        $columns = [];
        if ($table) {
            $columns = DB::connection()->getSchemaBuilder()->getColumnListing($table);
            $columns = array_flip($columns);
            $ignores = [
                'id', getCreatedAtColumn(), getCreatedByColumn(), getUpdatedAtColumn(), getUpdatedByColumn(), getDelFlagColumn()
            ];
            foreach ($ignores as $ignore) {
                unset($columns[$ignore]);
            }
            $columns = array_flip($columns);
        }
        $this->setViewData(['columns' => $columns]);
        return $this->render('backend.pl_import.table_columns');
    }
}
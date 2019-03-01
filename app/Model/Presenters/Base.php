<?php

namespace App\Model\Presenters;

use App\Helpers\Facades\CustomStorage;
use Illuminate\Support\Carbon;

/**
 * Trait Base
 * @package App\Model\Presenters
 */
trait Base
{
    /**
     * @param string $field
     * @param array $options
     * @return string
     */
    public function getTmpFile($field = '', $options = [
        'name' => 'img',
        'class' => 'tmp-file',
        'height' => '250px'
    ])
    {
        $o = '';
        $options['src'] = $this->tmp_file ? $this->getFileUrl(array_get($this->tmp_file, $field)) : $this->getFileUrl($this->$field);
        foreach ($options as $key => $option) {
            $o .= $key . '="' . $option . '" ';
        }
        $html = '<img ' . $o . '/>';
        return $html;
    }

    /**
     * @param string $field
     * @param array $options
     * @return string
     */
    public function getTmpFile2($field = '', $options = [ 'name' => 'img', 'class' => 'tmp-file'])
    {
        $options['height'] = isset($options['height']) ? $options['height'] : (isMobile() ? '150px' : '250px');
        $o = '';
        $fileName = $this->tmp_file && array_has($this->tmp_file, $field) ? $this->getFileUrl(array_get($this->tmp_file, $field)) : $this->getFileUrl(array_get($this, $field));

        if (isVideo($fileName)) {
            data_set($options, 'controls', '', false);
            foreach ($options as $key => $option) {
                $o .= $key . '="' . $option . '" ';
            }
            $html = '<video ' . $o . '><source src="' . $fileName . '"></video>';
        } else {
            $options['src'] = $fileName;
            foreach ($options as $key => $option) {
                $o .= $key . '="' . $option . '" ';
            }
            $html = '<img ' . $o . '/>';
        }

        return $html;
    }

    /**
     * @param string $field
     * @param array $options
     * @return string
     */
    public function getImgView($field = '', $options = [
        'refresh' => false,
        'class' => 'img',
        'height' => '150px'
    ])
    {
        $o = '';
        $options['class'] = isset($options['class']) ? $options['class'] : 'img';
        $options['src'] = $this->getFileUrl($this->$field);
        if (isset($options['refresh']) && $options['refresh']) {
            $options['src'] .= '?v=' . time();
        }
        foreach ($options as $key => $option) {
            $o .= $key . '="' . $option . '" ';
        }
        $html = '<img ' . $o . '/>';
        return $html;
    }


    /**
     * @param $fileName
     * @return mixed
     */
    public function getFileUrl($fileName)
    {
        if(isBase64Img($fileName) || strpos($fileName, 'http') !== false){
            return $fileName;
        }
        return config('filesystems.default') == 'public' ? public_url($fileName) : CustomStorage::url($fileName);
    }

    /**
     * @param $fileName
     * @return mixed
     */
    public function getFilePath($fileName)
    {
        if(config('filesystems.default') != 'public'){
            return $fileName;
        }
        return public_path(str_replace(public_url(''), '', $fileName));
    }


    /**
     * @return bool
     */
    public function isDeleted()
    {
        return $this->{getDelFlagColumn()} == $this->getDelFlagValue(true);
    }

    /**
     * @param string $format
     * @return string
     */
    public function getCreatedAtValue($format = 'Y-m-d H:i:s')
    {
        return Carbon::parse($this->{getCreatedAtColumn()})->format($format);
    }

    /**
     * @param string $format
     * @return string
     */
    public function getUpdatedAtValue($format = 'Y-m-d H:i:s')
    {
        return Carbon::parse($this->{getUpdatedAtColumn()})->format($format);
    }

    /**
     * @param string $format
     * @return string
     */
    public function getDeletedAtValue($format = 'Y-m-d H:i:s')
    {
        return Carbon::parse($this->{getDeletedAtColumn()})->format($format);
    }

    /**
     * @return mixed
     */
    public function getDeletedByValue()
    {
        return $this->{getDeletedByColumn()};
    }

    /**
     * @return mixed
     */
    public function getUpdatedByValue()
    {
        return $this->{getUpdatedByColumn()};
    }

    /**
     * @return mixed
     */
    public function getCreatedByValue()
    {
        return $this->{getCreatedByColumn()};
    }

    public function trans($attribute, $value = '')
    {
        return $value;
    }

    public function isOpen()
    {
        return $this->open_flag == getConstant('OPEN_FLAG_ACTIVE');
    }
}
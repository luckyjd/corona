<?php
function buildDashBoardUrl()
{
    return route('dashboard.index', buildDashBoardParamsDefault());
}

function buildDashBoardParamsDefault()
{
    return [];
}

function myEncrypt($string, $key)
{
    $result = '';
    for ($i = 0; $i < strlen($string); $i++) {
        $char = substr($string, $i, 1);
        $keyChar = substr($key, ($i % strlen($key)) - 1, 1);
        $char = chr(ord($char) + ord($keyChar));
        $result .= $char;
    }

    return base64_encode($result);
}

function myDecrypt($string, $key)
{
    $result = '';
    $string = base64_decode($string);

    for ($i = 0; $i < strlen($string); $i++) {
        $char = substr($string, $i, 1);
        $keyChar = substr($key, ($i % strlen($key)) - 1, 1);
        $char = chr(ord($char) - ord($keyChar));
        $result .= $char;
    }

    return $result;
}

function getApplicationGameUrl($url, $serialNumber, $key)
{
    return $url . '/' . $serialNumber . '/' . $key;
}

function serialIsLimited($total)
{
    return $total >= getConstant('MAX_QUANTITY');
}

function convertTelUser($tel)
{
    $tel =  trim($tel);
    $tmp = (strlen($tel) == 10) ? 3 : 4;

    return [
        'phone1' => substr($tel,0,$tmp),
        'phone2' => substr($tel,$tmp,3),
        'phone3' => substr($tel,6,4)
    ];
}

function convertZipcodeUser($code)
{
    $code =  trim($code);

    return [
        'zip1' => substr($code,0,3),
        'zip2' => substr($code,3),
    ];
}

function matchZipcode($code = null)
{
    $code =  trim($code);

    if ($code[0] == 0) {
        return $code[1];
    }

    return $code;
}

/**
 * Returns the version of Internet Explorer or false
 */
function isIE()
{
    return preg_match('~MSIE|Internet Explorer~i', $_SERVER['HTTP_USER_AGENT']) || (strpos($_SERVER['HTTP_USER_AGENT'], 'Trident/7.0; rv:11.0') !== false);
}
<?php

if (!function_exists('mb_ucfirst')) {

    function mb_ucfirst($str, $encoding = "UTF-8", $lower_str_end = false) {
        $first_letter = mb_strtoupper(mb_substr($str, 0, 1, $encoding), $encoding);
        $str_end = "";

        if ($lower_str_end)
            $str_end = mb_strtolower(mb_substr($str, 1, mb_strlen($str, $encoding), $encoding), $encoding);
        else
            $str_end = mb_substr($str, 1, mb_strlen($str, $encoding), $encoding);

        $str = $first_letter . $str_end;
        return $str;
    }

}

function ___($key, $replace = [], $locale = null) {
    $return = __($key, $replace, $locale);
    $return = mb_ucfirst($return, 'UTF-8');

    return $return;
}

function trans_nodiacritics($key, $capitalize = false) {
    if ($capitalize)
        $return = ___($key);
    else
        $return = __($key);

    $return = no_diacritics($return);

    return $return;
}

function no_diacritics($text) {
    $return = strtr($text, ['Äƒ' => 'a', 'Ã¢' => 'a', 'Ã®' => 'i', 'È™' => 's', 'È›' => 't', 'Ä‚' => 'A', 'Ã‚' => 'A', 'ÃŽ' => 'I', 'È˜' => 'S', 'Èš' => 'T',]);
    return $return;
}

function recursiveKeySort(array &$data) {
    ksort($data, SORT_STRING);
    foreach ($data as $key => $value) {
        if (is_array($value)) {
            recursiveKeySort($data[$key]);
        }
    }
}

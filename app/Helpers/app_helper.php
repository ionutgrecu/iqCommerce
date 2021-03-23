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

/** Check if the input (array or string) is or contain the $checkedValue
 * 
 * @param string|array $input
 * @param string $checkedValue
 * @return bool
 */
function checkIfInput($input, string $checkedValue): bool {
    if ((is_string($input) && $checkedValue === $input) || (is_array($input) && in_array($checkedValue, $input)))
        return true;
    else
        return false;
}

function toSqlBinds($builder) {
    if (is_a($builder, '\Illuminate\Database\Query\Builder') || is_a($builder, '\Illuminate\Database\Eloquent\Builder'))
        return Str::replaceArray('?', $builder->getBindings(), $builder->toSql());
    else
        throw new Error(__FILE__ . "@" . __FUNCTION__ . ' line ' . __LINE__ . '. Parameter passed is not a builder');
}

function exceptionToArray(Exception $ex): array {
    return [
        'status' => 'failed',
        'message' => $ex->getMessage(),
        'code' => $ex->getCode(),
    ];
}

function formatPrice(float $price): string {
    return number_format($price, 2, '.', ' ');
}

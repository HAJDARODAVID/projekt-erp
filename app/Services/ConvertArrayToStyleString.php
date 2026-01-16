<?php

namespace App\Services;

/**
 * Class ConvertArrayToStyleString.
 */
class ConvertArrayToStyleString
{
    public static function array(array $array): string
    {
        $output = [];
        foreach ($array as $key => $value) {
            $output[] = $key . ': ' . $value;
        }
        $output = implode(';', $output);
        return $output;
    }
}

<?php

namespace App\Services\Application;

class KebabToPascalCase
{
    /**
     * Helping method for converting string from first-test to FirstTest
     * 
     * @param string $string String to be converted.
     * @return string The converted string Exp: FirstTest
     */
    public static function convert(string|NULL $string)
    {
        $output = '';
        $explosion = explode('-', $string);
        foreach ($explosion as $value) {
            $output .= ucfirst($value);
        }
        return $output;
    }
}

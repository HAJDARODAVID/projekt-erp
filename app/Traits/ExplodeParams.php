<?php

namespace App\Traits;

trait ExplodeParams
{
    private function explodeParams(string $params, array $keys = [], $separator = ',')
    {
        /**Explode params to array */
        $arrayExploded = explode($separator, $params);

        /**Remove whitespace  and add to final array*/
        $finalArray = [];
        foreach ($arrayExploded as $key => $value) {
            if (isset($keys[$key])) {
                $finalArray[$keys[$key]] = trim($value);
            }
        }
        return $finalArray;
    }
}

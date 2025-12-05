<?php

namespace App\Services;

/**
 * Class Years.
 */
class Years
{
    public static function getYearsList()
    {
        $currentYear = date("Y");
        $yearZero = 2024;
        $goBack = $currentYear - $yearZero;
        $years = [];

        for ($i = 0; $i <= $goBack; $i++) {
            $year[$yearZero + $i] = $yearZero + $i;
        }
        $year[$currentYear + 1] = $currentYear + 1;

        return $year;
    }
}

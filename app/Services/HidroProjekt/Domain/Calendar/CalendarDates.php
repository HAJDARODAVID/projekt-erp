<?php

namespace App\Services\HidroProjekt\Domain\Calendar;

use DatePeriod;
use DateInterval;

class CalendarDates{

    public static function getDatesForCalendar($month,$year){
        $startDate = date_create($year.'-'.$month.'-01');
        $decreaseDateBy = $startDate->format('N')-1;
        $startDate->modify('-'.$decreaseDateBy.' days');
        $endDate = date_create($year.'-'. $month +1 . '-01')->modify('-1 days');
        $increaseDateBy = 8- $endDate->format('N');
        $endDate->modify('+'.$increaseDateBy.' days');
        $interval = new DateInterval('P1D');
        $date_range = new DatePeriod($startDate, $interval, $endDate);
        $dayArray=[];
        foreach ($date_range as $day) {
            $dayArray[$day->format("W")][$day->format("d.m.Y")]=['date' => $day];
        }
        return $dayArray;
    }
}
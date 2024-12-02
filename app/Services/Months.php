<?php

namespace App\Services;

use DatePeriod;
use DateInterval;

/**
 * Class Months.
 */
class Months
{
    const MONTH_JANUARY   = 1;
    const MONTH_FEBRUARY  = 2;
    const MONTH_MARCH     = 3;
    const MONTH_APRIL     = 4;
    const MONTH_MAY       = 5;
    const MONTH_JUNE      = 6;
    const MONTH_JULY      = 7;
    const MONTH_AUGUST    = 8;
    const MONTH_SEPTEMBER = 9;
    const MONTH_OCTOBER   = 10;
    const MONTH_NOVEMBER  = 11;
    const MONTH_DECEMBER  = 12;

    const MONTHS_HR=array(
        self::MONTH_JANUARY   => 'Siječanj',
        self::MONTH_FEBRUARY  => 'Veljača',
        self::MONTH_MARCH     => 'Ožujak',
        self::MONTH_APRIL     => 'Travanj',
        self::MONTH_MAY       => 'Svibanj',
        self::MONTH_JUNE      => 'Lipanj',
        self::MONTH_JULY      => 'Srpanj',
        self::MONTH_AUGUST    => 'Kolovoz',
        self::MONTH_SEPTEMBER => 'Rujan',
        self::MONTH_OCTOBER   => 'Listopad',
        self::MONTH_NOVEMBER  => 'Studeni',
        self::MONTH_DECEMBER  => 'Prosinac',
    );

    public static function dayOfMonth($month, $year=2024){
        $startDate = date_create($year.'-'.$month.'-01');
        if($month == 12){
            $endDate = date_create(date("Y-m-d",strtotime($year + 1 .'-01-01')));
        }else{
            $endDate = date_create(date("Y-m-d",strtotime($year.'-'.$month + 1 .'-01')));
        }
        $interval = new DateInterval('P1D');
        $date_range = new DatePeriod($startDate, $interval, $endDate);
        $dayArray=[];
        foreach ($date_range as $day) {
            $dayArray[]=$day->format("Y-m-d");
        }
        return $dayArray;
    }
}

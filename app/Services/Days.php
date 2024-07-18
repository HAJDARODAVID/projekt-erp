<?php

namespace App\Services;

class Days
{
    const DAY_MONDAY    = 1;
    const DAY_TUESDAY   = 2;
    const DAY_WEDNESDAY = 3;
    const DAY_THURSDAY  = 4;
    const DAY_FRIDAY    = 5;
    const DAY_SATURDAY  = 6;
    const DAY_SUNDAY    = 7;

    const DAYS_EN = [
        self::DAY_MONDAY    => 'Monday',
        self::DAY_TUESDAY   => 'Tuesday',
        self::DAY_WEDNESDAY => 'Wednesday',
        self::DAY_THURSDAY  => 'Thursday',
        self::DAY_FRIDAY    => 'Friday',
        self::DAY_SATURDAY  => 'Saturday',
        self::DAY_SUNDAY    => 'Sunday',
    ];

    const DAYS_HR = [
        self::DAY_MONDAY    => 'Ponedjeljak',
        self::DAY_TUESDAY   => 'Utorak',
        self::DAY_WEDNESDAY => 'Srijeda',
        self::DAY_THURSDAY  => 'Četvrtak',
        self::DAY_FRIDAY    => 'Petak',
        self::DAY_SATURDAY  => 'Subota',
        self::DAY_SUNDAY    => 'Nedjelja',
    ];

    const DAYS_HR_SHT = [
        self::DAY_MONDAY    => 'PON',
        self::DAY_TUESDAY   => 'UTO',
        self::DAY_WEDNESDAY => 'SRI',
        self::DAY_THURSDAY  => 'ČET',
        self::DAY_FRIDAY    => 'PET',
        self::DAY_SATURDAY  => 'SUB',
        self::DAY_SUNDAY    => 'NED',
    ];

}
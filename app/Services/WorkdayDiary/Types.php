<?php

namespace App\Services\WorkdayDiary;

/**
 * Class Types.
 */
class Types
{
    const TYPE_HOME       = 1;
    const TYPE_FIELD_WORK = 2;
    const TYPE_MISC_WORK  = 3;

    const AVAILABLE_TYPE_BDE = [
        self::TYPE_HOME => 'Doma',
        self::TYPE_FIELD_WORK => 'Teren',
    ];

    public static function home()
    {
        return self::TYPE_HOME;
    }

    public static function field()
    {
        return self::TYPE_FIELD_WORK;
    }

    public static function bdeType()
    {
        return self::AVAILABLE_TYPE_BDE;
    }
}

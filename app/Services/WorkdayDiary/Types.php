<?php

namespace App\Services\WorkdayDiary;

/**
 * Class Types.
 */
class Types
{
    private $type;

    const TYPE_HOME       = 1;
    const TYPE_FIELD_WORK = 2;
    const TYPE_MISC_WORK  = 3;

    const WORK_TYPES = [
        self::TYPE_HOME       => 'Home',
        self::TYPE_FIELD_WORK => 'Filed',
        self::TYPE_MISC_WORK  => 'Misc'
    ];

    const AVAILABLE_TYPE_BDE = [
        self::TYPE_HOME => 'Doma',
        self::TYPE_FIELD_WORK => 'Teren',
    ];

    const TYPES_FOR_REPORT = [
        self::TYPE_HOME => 'work-home',
        self::TYPE_FIELD_WORK => 'work-field',
        self::TYPE_MISC_WORK  => 'work-misc'
    ];

    private function __construct($type)
    {
        if (key_exists($type, self::WORK_TYPES)) $this->type = $type;
    }

    /**
     * Create a new empty instance
     * 
     * @return self
     */
    public static function init()
    {
        return new self(NULL);
    }

    /**
     * Set a new instance from work type
     * 
     * @param string $type Passthru the work type
     * @return self
     */
    public static function setByType(string $type)
    {
        return key_exists($type, self::WORK_TYPES) ? new self($type) : NULL;
    }

    /**
     * Get description for report purposes.
     * 
     * @return string
     */
    public function getReportDesc()
    {
        return self::TYPES_FOR_REPORT[$this->type];
    }

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

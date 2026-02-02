<?php

namespace App\Models\Jobs;

class ConstructionSiteStatus
{
    private $status;

    const CONSTRUCTION_STATUS_DISABLED    = -1;
    const CONSTRUCTION_STATUS_INITIALIZED = 0;
    const CONSTRUCTION_STATUS_ACTIVE      = 1;
    const CONSTRUCTION_STATUS_DONE        = 2;

    const CONSTRUCTION_STATUS = array(
        self::CONSTRUCTION_STATUS_DISABLED    => 'Cancelled',
        self::CONSTRUCTION_STATUS_INITIALIZED => 'Initialized',
        self::CONSTRUCTION_STATUS_ACTIVE      => 'Active',
        self::CONSTRUCTION_STATUS_DONE        => 'Done',
    );

    private function __construct($status)
    {
        if (key_exists($status, self::CONSTRUCTION_STATUS)) $this->status = $status;
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
     * Set a new instance from a worker status
     * 
     * @param int $status Passthru the worker status
     * @return self
     */
    public static function setByStatus(int $status)
    {
        return new self($status);
    }

    /**
     * Get the disabled status from static
     * 
     * @return int
     */
    public static function disabled()
    {
        return self::CONSTRUCTION_STATUS_DISABLED;
    }

    /**
     * Get the initialized status from static
     * 
     * @return int
     */
    public static function initialized()
    {
        return self::CONSTRUCTION_STATUS_INITIALIZED;
    }

    /**
     * Get the active status from static
     * 
     * @return int
     */
    public static function active()
    {
        return self::CONSTRUCTION_STATUS_ACTIVE;
    }

    /**
     * Get the done status from static
     * 
     * @return int
     */
    public static function done()
    {
        return self::CONSTRUCTION_STATUS_DONE;
    }
}

<?php

namespace App\Models\Employees;

class WorkerStatus
{
    private $status;

    const WORKER_STATUS_ACTIVE          = 1;
    const WORKER_STATUS_LONG_SICK_LEAVE = 2;
    const WORKER_STATUS_INACTIVE        = -1;

    const WORKER_STATUS_DESCRIPTION = [
        self::WORKER_STATUS_ACTIVE          => 'Active',
        self::WORKER_STATUS_LONG_SICK_LEAVE => 'Long sick leave',
        self::WORKER_STATUS_INACTIVE        => 'inactive',
    ];

    const WORKER_STATUS_DESCRIPTION_HR = [
        self::WORKER_STATUS_ACTIVE => 'Aktivno zaposlen',
        self::WORKER_STATUS_INACTIVE     => 'Nije zaposlen',
    ];

    private function __construct($status)
    {
        if (key_exists($status, self::WORKER_STATUS_DESCRIPTION_HR)) $this->status = $status;
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
     * Set a new instance for a active worker
     * 
     * @return self
     */
    public static function setStatusActive()
    {
        return new self(self::WORKER_STATUS_ACTIVE);
    }

    /**
     * Set a new instance for a inactive worker
     * 
     * @return self
     */
    public static function setStatusInactive()
    {
        return new self(self::WORKER_STATUS_INACTIVE);
    }

    /**
     * Set a new instance for a inactive worker
     * 
     * @return self
     */
    public static function setStatusLongSickLeave()
    {
        return new self(self::WORKER_STATUS_LONG_SICK_LEAVE);
    }

    /**
     * Get the worker status
     * 
     * @return int
     */
    public function getStatus()
    {
        return $this->status;
    }

    /**
     * Get the status description
     * 
     * @return string
     */
    public function description()
    {
        return self::WORKER_STATUS_DESCRIPTION_HR[$this->status];
    }
}

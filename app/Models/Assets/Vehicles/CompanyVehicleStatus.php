<?php

namespace App\Models\Assets\Vehicles;

class CompanyVehicleStatus
{
    private $status;

    const COMPANY_VEHICLE_STATUS_ACTIVE   = 1;
    const COMPANY_VEHICLE_STATUS_INACTIVE = -1;

    const COMPANY_VEHICLE_STATUS = array(
        self::COMPANY_VEHICLE_STATUS_ACTIVE   => 'Active',
        self::COMPANY_VEHICLE_STATUS_INACTIVE => 'Decommissioned',
    );

    private function __construct($status)
    {
        if (key_exists($status, self::COMPANY_VEHICLE_STATUS)) $this->status = $status;
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
     * Set a new instance from a vehicle status
     * 
     * @param int $status Passthru the vehicle status
     * @return self
     */
    public static function setByStatus(int $status)
    {
        return new self($status);
    }

    /**
     * Set a new instance for a active vehicle
     * 
     * @return self
     */
    public static function setStatusActive()
    {
        return new self(self::COMPANY_VEHICLE_STATUS_ACTIVE);
    }

    /**
     * Set a new instance for a inactive vehicle
     * 
     * @return self
     */
    public static function setStatusInactive()
    {
        return new self(self::COMPANY_VEHICLE_STATUS_INACTIVE);
    }

    /**
     * Get the vehicle status
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
        return self::COMPANY_VEHICLE_STATUS[$this->status];
    }

    /**
     * Check if the vehicle is active 
     * 
     * @return bool
     */
    public function isActive()
    {
        return $this->status == self::COMPANY_VEHICLE_STATUS_ACTIVE ? TRUE : FALSE;
    }
}

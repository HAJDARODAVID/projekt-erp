<?php

namespace App\Services\Assets\Vehicles;

use App\Services\BaseDTO;

/**
 * Class VehicleMileageDto.
 */
class VehicleMileageDto extends BaseDTO
{
    /**
     * The mileage traveled.
     */
    protected $mileage = 0;

    /**
     * The mileage traveled in €. 
     * 
     */
    protected $mileageValue = 0;

    /**
     * Get the mileage traveled
     */
    public function getMileage()
    {
        return $this->mileage;
    }

    /**
     * Set the mileage traveled
     *
     * @return  self
     */
    public function setMileage($mileage)
    {
        $this->mileage = $mileage;

        return $this;
    }

    /**
     * Get the mileage traveled in €.
     */
    public function getMileageValue()
    {
        return $this->mileageValue;
    }

    /**
     * Set the mileage traveled in €.
     *
     * @return  self
     */
    public function setMileageValue($mileageValue)
    {
        $this->mileageValue = $mileageValue;

        return $this;
    }
}

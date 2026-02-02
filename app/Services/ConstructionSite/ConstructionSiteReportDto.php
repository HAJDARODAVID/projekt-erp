<?php

namespace App\Services\ConstructionSite;

use App\Services\BaseDTO;

/**
 * Class GetConstructionSiteReportData.
 */
class ConstructionSiteReportDto extends BaseDTO
{
    /**Value of materials currently on stock at a specific construction site */
    protected $onStockValue;

    /**The overall value of materials that have been used */
    protected $consumptionsValue;

    /**Overall work hours used for a specific construction site  */
    protected $workHours;

    /**The value based on the $workHours and set hours-worker cost */
    protected $workHoursValue;

    /**Overall vehicle cost */
    protected $allocatedVehicleExpense;

    /**ID of the job site / construction site */
    protected $jobSiteID;

    /**Job site / construction site name*/
    protected $jobSiteName;

    /**Job site / construction site status*/
    protected $jobSiteStatus;

    /**Overall construction site cost*/
    protected $total;

    /**
     * Get the value of onStockValue
     */
    public function getOnStockValue()
    {
        return $this->onStockValue;
    }

    /**
     * Set the value of onStockValue
     *
     * @return  self
     */
    public function setOnStockValue($onStockValue)
    {
        $this->onStockValue = $onStockValue;

        return $this;
    }

    /**
     * Get the value of consumptionsValue
     */
    public function getConsumptionsValue()
    {
        return $this->consumptionsValue;
    }

    /**
     * Set the value of consumptionsValue
     *
     * @return  self
     */
    public function setConsumptionsValue($consumptionsValue)
    {
        $this->consumptionsValue = $consumptionsValue;

        return $this;
    }

    /**
     * Get the value of workHours
     */
    public function getWorkHours()
    {
        return $this->workHours;
    }

    /**
     * Set the value of workHours
     *
     * @return  self
     */
    public function setWorkHours($workHours)
    {
        $this->workHours = $workHours;

        return $this;
    }

    /**
     * Get the value of workHoursValue
     */
    public function getWorkHoursValue()
    {
        return $this->workHoursValue;
    }

    /**
     * Set the value of workHoursValue
     *
     * @return  self
     */
    public function setWorkHoursValue($workHoursValue)
    {
        $this->workHoursValue = $workHoursValue;

        return $this;
    }

    /**
     * Get the value of allocatedVehicleExpense
     */
    public function getAllocatedVehicleExpense()
    {
        return $this->allocatedVehicleExpense;
    }

    /**
     * Set the value of allocatedVehicleExpense
     *
     * @return  self
     */
    public function setAllocatedVehicleExpense($allocatedVehicleExpense)
    {
        $this->allocatedVehicleExpense = $allocatedVehicleExpense;

        return $this;
    }

    /**
     * Get the value of jobSiteID
     */
    public function getJobSiteID()
    {
        return $this->jobSiteID;
    }

    /**
     * Set the value of jobSiteID
     *
     * @return  self
     */
    public function setJobSiteID($jobSiteID)
    {
        $this->jobSiteID = $jobSiteID;

        return $this;
    }

    /**
     * Get the value of jobSiteName
     */
    public function getJobSiteName()
    {
        return $this->jobSiteName;
    }

    /**
     * Set the value of jobSiteName
     *
     * @return  self
     */
    public function setJobSiteName($jobSiteName)
    {
        $this->jobSiteName = $jobSiteName;

        return $this;
    }

    /**
     * Get the value of jobSiteStatus
     */
    public function getJobSiteStatus()
    {
        return $this->jobSiteStatus;
    }

    /**
     * Set the value of jobSiteStatus
     *
     * @return  self
     */
    public function setJobSiteStatus($jobSiteStatus)
    {
        $this->jobSiteStatus = $jobSiteStatus;

        return $this;
    }

    /**
     * Get the value of total
     */
    public function getTotal()
    {
        return $this->total;
    }

    /**
     * Set the value of total
     *
     * @return  self
     */
    public function setTotal($total)
    {
        $this->total = $total;

        return $this;
    }
}

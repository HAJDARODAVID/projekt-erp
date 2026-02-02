<?php

namespace App\Services\ConstructionSite;

/**
 * Class ConstructionSiteHoursDto.
 */
class ConstructionSiteHoursDto
{

    /**Define the hours that my workers have done */
    private $companyHours = 0;

    /**Define the hours that the contractors have done */
    private $contractorsHours = 0;

    /**
     * Get the value of companyHours
     */
    public function getCompanyHours()
    {
        return $this->companyHours;
    }

    /**
     * Set the value of companyHours
     *
     * @return  self
     */
    public function setCompanyHours($companyHours)
    {
        $this->companyHours = $companyHours;

        return $this;
    }

    /**
     * Get the value of contractorsHours
     */
    public function getContractorsHours()
    {
        return $this->contractorsHours;
    }

    /**
     * Set the value of contractorsHours
     *
     * @return  self
     */
    public function setContractorsHours($contractorsHours)
    {
        $this->contractorsHours = $contractorsHours;

        return $this;
    }

    /**
     * Get the overall hours.
     * Sum of $companyHours + $contractorsHours
     */
    public function getOverAllHours()
    {
        return $this->companyHours + $this->contractorsHours;
    }
}

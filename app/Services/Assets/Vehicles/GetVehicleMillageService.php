<?php

namespace App\Services\Assets\Vehicles;

use App\Services\BaseService;
use App\Models\AppParametersModel;
use App\Models\Jobs\ConstructionSite;
use App\Models\Assets\Vehicles\CompanyVehicle;
use App\Models\Assets\Vehicles\VehicleMileage;

/**
 * Class GetVehicleMillageService.
 */
class GetVehicleMillageService extends BaseService
{
    /** @var CompanyVehicle|NULL */
    private $companyVehicle = NULL;

    /** @var array|int */
    private $wdr = [];

    public function __construct(?CompanyVehicle $companyVehicle = NULL)
    {
        $this->companyVehicle = $companyVehicle;
    }

    //TODO: create this method
    public static function setByWdr() {}

    /**
     * Set the wdr-id's for a specific job site.
     * 
     * @return self
     */
    public function getByJobSite(ConstructionSite $constructionSite): self
    {
        $this->wdr = $constructionSite->getAllWdrID();
        return $this;
    }

    /**
     * Execute this service and get the vehicle millage.
     * 
     * @return VehicleMileageDto
     */
    public function execute(): VehicleMileageDto
    {
        $vehicleMileageDto = new VehicleMileageDto;
        $vehicleMileage = new VehicleMileage;
        if ($this->companyVehicle) $vehicleMileage = $vehicleMileage->where('car_id', $this->companyVehicle->id);
        if (!empty($this->wdr)) $vehicleMileage = $vehicleMileage->whereIn('wdr_id', $this->wdr);
        $vehicleMileage = $vehicleMileage->get();
        if ($vehicleMileage->count() === 0 || ($this->companyVehicle == NULL && empty($this->wdr))) return $vehicleMileageDto;
        $output = 0;
        foreach ($vehicleMileage as $item) {
            $output += $item->end_mileage - $item->start_mileage;
        }
        $vehicleMileageDto->setMileage($output)->setMileageValue($vehicleMileageDto->getMileage() * AppParametersModel::where('param_name_srt', 'bwcc')->first()->value);

        return $vehicleMileageDto;
    }
}

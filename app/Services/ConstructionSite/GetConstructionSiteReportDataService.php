<?php

namespace App\Services\ConstructionSite;

use App\Services\BaseService;
use App\Models\AppParametersModel;
use App\Models\Jobs\ConstructionSite;
use App\Services\Assets\Vehicles\GetVehicleMillageService;
use App\Services\ConstructionSite\ConstructionSiteReportDto;
use App\Services\ConstructionSite\ConstructionSiteMaterialsInfoService;
use App\Services\ConstructionSite\GetConstructionSiteOverallHoursService;

/**
 * Class GetConstructionSiteReportDataService.
 */
class GetConstructionSiteReportDataService extends BaseService
{
    /** @var ConstructionSite */
    private $constructionSite;

    public function __construct(ConstructionSite $constructionSite)
    {
        $this->constructionSite = $constructionSite;
    }

    /**
     * Getter all the data for a specific construction site
     */
    public function execute(): self|ConstructionSiteReportDto
    {
        try {
            /**TODO: create a better solution for app params */
            $appParams = AppParametersModel::whereIn('param_name_srt', ['bwhv-t', 'bwh-c-o'])->pluck('value', 'param_name_srt')->toArray();

            $constructionSiteReportDto = new ConstructionSiteReportDto;
            $constructionSiteReportDto->setJobSiteID($this->constructionSite->id)
                ->setJobSiteName($this->constructionSite->name)
                ->setJobSiteStatus($this->constructionSite->status);

            $workHoursService = (new GetConstructionSiteOverallHoursService($this->constructionSite))->execute();
            $constructionSiteReportDto->setWorkHours($workHoursService->getOverAllHours())
                ->setWorkHoursValue(($workHoursService->getCompanyHours() * $appParams['bwhv-t']) + ($workHoursService->getContractorsHours() * $appParams['bwh-c-o']));

            $constructionSiteMaterialsInfoService = (new ConstructionSiteMaterialsInfoService($this->constructionSite))->execute();
            $constructionSiteReportDto->setOnStockValue($constructionSiteMaterialsInfoService->getMaterialsOnStockValue())
                ->setConsumptionsValue($constructionSiteMaterialsInfoService->getConsumedMaterialsValue());

            $getVehicleMillageService = (new GetVehicleMillageService)->getByJobSite($this->constructionSite)->execute();
            $constructionSiteReportDto->setAllocatedVehicleExpense($getVehicleMillageService->getMileageValue());

            $constructionSiteReportDto->setTotal($constructionSiteReportDto->getAllocatedVehicleExpense() + $constructionSiteReportDto->getWorkHoursValue() + $constructionSiteReportDto->getOnStockValue() + $constructionSiteReportDto->getConsumptionsValue());

            $this->setData($constructionSiteReportDto);
        } catch (\Throwable $th) {
            $this->setErrorMessage($th->getMessage());
        }
        return $this;
    }
}

<?php

namespace App\Services\ConstructionSite;

use App\Services\BaseService;
use App\Models\Jobs\ConstructionSite;
use App\Models\WorkingDayRecordModel;
use App\Models\Materials\StorageStockItems;
use App\Models\Materials\MaterialConsumption;
use App\Services\ConstructionSite\ConstructionSiteMaterialsInfoDto;

/**
 * Class ConstructionSiteMaterialsInfoService.
 */
class ConstructionSiteMaterialsInfoService extends BaseService
{
    /** @var ConstructionSite */
    private $constructionSite;

    public function __construct(ConstructionSite $constructionSite)
    {
        $this->constructionSite = $constructionSite;
    }

    /**
     * Execute the service
     */
    public function execute(): ConstructionSiteMaterialsInfoDto
    {
        $constructionSiteMaterialsInfoDto = new ConstructionSiteMaterialsInfoDto;
        $onStockItems = StorageStockItems::where('cons_id', $this->constructionSite->id)->where('qty', '!=', 0)->with('getMaterialInfo')->get();
        $onStockValue = 0;
        foreach ($onStockItems as $item) {
            $onStockValue += $item->qty * $item->getMaterialInfo->price;
        }
        $constructionSiteMaterialsInfoDto->setMaterialsOnStockValue($onStockValue)->setMaterialsOnStock($onStockItems->pluck('qty', 'mat_id')->toArray());

        /**TODO:Change WorkingDayRecordModel to a new model */
        $wdrArray = WorkingDayRecordModel::where('construction_site_id', $this->constructionSite->id)->pluck('id')->toArray();
        $materialConsumption = MaterialConsumption::whereIn('wdr_id', $wdrArray)->with('getConsumptionItems')->get();
        $consumptionValue = 0;
        $consumptionValueArray = [];
        foreach ($materialConsumption as $consumption) {
            foreach ($consumption->getConsumptionItems as $consumptionItem) {
                $consumptionValue += $consumptionItem->cost;
                if (isset($consumptionValueArray[$consumptionItem->mat_id])) {
                    $consumptionValueArray[$consumptionItem->mat_id] = $consumptionValueArray[$consumptionItem->mat_id] + $consumptionItem->qty;
                } else {
                    $consumptionValueArray[$consumptionItem->mat_id] = $consumptionItem->qty;
                }
            }
        }
        $constructionSiteMaterialsInfoDto->setConsumedMaterials($consumptionValueArray)->setConsumedMaterialsValue($consumptionValue);
        return $constructionSiteMaterialsInfoDto;
    }
}

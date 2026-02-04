<?php

namespace App\Services\ConstructionSite;

use App\Services\Application\ExcelDataMapper;

class ConstructionSiteReportExportDto extends ExcelDataMapper
{
    public function prepare(): void
    {
        $this->removeKeyFromData('show-array-item-search', 'jobSiteStatus')
            ->setColumnHeaders([
                "onStockValue"            => "On stock",
                "consumptionsValue"       => "Consumption",
                "workHours"               => "Work hours[h]",
                "workHoursValue"          => "Work hours[€]",
                "allocatedVehicleExpense" => "Vehicle cost",
                "jobSiteID"               => "#",
                "jobSiteName"             => "Construction site",
                "total"                   => "Total",
            ])->reorderByKeys('jobSiteID', 'jobSiteName')->replaceNullWithZero()->devShow(FALSE);
    }
}

<?php

namespace App\Services\Attendance;

use App\Services\Application\ExcelDataMapper;

class MonthlyHoursReportExportDto extends ExcelDataMapper
{
    public function prepare(): void
    {
        $this->removeKeyFromData('show-array-item-search', 'status', 'work-misc')
            ->replaceBoolWith('bonus', 'O', 'X')
            ->setColumnHeaders([
                "name"             => "Worker",
                "work-hours"       => "Work hours",
                "work-hours-total" => "Total",
                "bonus"            => "Bonus",
                "work-home"        => "Home",
                "work-field"       => "Field"
            ])
            ->setSpecialHeader([
                ['monthly hours report'],
                ['Month', 'addInfo.month'],
                ['Year', 'addInfo.year'],
            ]);
        //->devShow();
    }
}

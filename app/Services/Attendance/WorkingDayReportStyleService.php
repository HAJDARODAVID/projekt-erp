<?php

namespace App\Services\Attendance;

use App\Models\Employees\AttendanceAbsenceType;

/**
 * Class WorkingDayReportStyleService.
 */
class WorkingDayReportStyleService
{
    /**Set a flag if overtime exceeds threshold */
    private $isOverThreshold = FALSE;

    /**
     * Return the style for missing attendance.
     * 
     * @return array
     */
    public function weekendStyle(): array
    {
        return [
            'background-color' => "#c9c9c9",
        ];
    }

    /**
     * Return the style for missing attendance.
     * 
     * @return array
     */
    public function attendanceMissing(): array
    {
        return [
            'background-color' => "#FF311C",
        ];
    }

    /**
     * Return the style attribute for a ERR attendance.
     * 
     * @return array
     */
    public function error(): array
    {
        return [
            'background-color' => "#000000",
            'font-weight' => 'bold',
            'font-size' => '11px',
            'color' => 'white',
            'padding' => '8px 5px',
        ];
    }

    /**
     * Style for hours attendance.
     * Consider the overtime threshold, and set style accordingly.
     * 
     * @return array
     */
    public function good(): array
    {
        $output = ['background-color' => '#67de43'];
        if ($this->isOverThreshold) {
            $output['font-weight'] = 'bold';
            $output['color'] = 'red';
        }
        return $output;
    }

    /**
     * Check if the given value is smaller then the threshold.
     * 
     * @return WorkingDayReportStyleService
     */
    public function checkIfOver($value, $threshold): self
    {
        $this->isOverThreshold = $value >= $threshold ? TRUE : FALSE;
        return $this;
    }

    /**
     * Return the style for sick leave attendance.
     * 
     * @return array
     */
    public function otherAbsence($absence): array
    {
        $attendanceAbsenceType = AttendanceAbsenceType::init();
        switch ($absence) {
            case $attendanceAbsenceType->getSickLeaveSht():
                return [
                    'background-color' => "#ff7e29",
                    'font-weight' => 'bold',
                ];
                break;
            case $attendanceAbsenceType->getPaidLeaveSht():
                return [
                    'background-color' => "#2998ff",
                    'font-weight' => 'bold',
                ];
                break;
            case $attendanceAbsenceType->getPaidLeaveSht():
                return [
                    'background-color' => "#b429ff",
                    'font-weight' => 'bold',
                ];
                break;
        }
        return [];
    }
}

<?php

namespace App\Services\Attendance;

use App\Models\Employees\Attendance;
use App\Models\Employees\AttendanceAbsenceType;
use App\Models\Employees\Worker;
use App\Services\Attendance\MonthlyHoursOverviewReportService;
use App\Services\BaseService;
use App\Services\ConstructionSite\GetConstructionSiteService;

/**
 * Class GetWorkerMonthlyAttendanceService.php.
 */
class GetWorkerMonthlyAttendanceService extends BaseService
{
    /** @var Worker */
    private $worker;

    /** Month for the data */
    private $month;

    /** Year for the data */
    private $year;

    public function __construct(Worker $worker, $month, $year)
    {
        $this->worker = $worker;
        $this->month  = $month;
        $this->year   = $year;
    }

    /**
     * Execute the service and get the data
     * 
     * @return GetWorkerMonthlyAttendanceService
     */
    public function execute(): self
    {
        $attendance = Attendance::where('worker_id', $this->worker->id)
            ->whereMonth('date', $this->month)
            ->whereYear('date', $this->year)
            ->orderBy('date', 'asc')
            ->get();
        $output = [];
        foreach ($attendance as $att) {
            $output['per-day'][$att->id] = [
                'id' => $att->id,
                'date' => $att->date,
                'wdr' => $att->working_day_record_id,
                'cs_name' => $att->working_day_record_id ? (GetConstructionSiteService::wdrID($att->working_day_record_id))->getConstructionSite()->name ?? NULL : NULL,
                'hours' => $att->work_hours,
                'type' => $att->type,
                'abs-sl' => $att->absence_reason == AttendanceAbsenceType::ABSENCE_TYPE_SICK_LEAVE ? TRUE : FALSE,
                'abs-pl' => $att->absence_reason == AttendanceAbsenceType::ABSENCE_TYPE_PAID_LEAVE ? TRUE : FALSE,
                'abs-hd' => $att->absence_reason == AttendanceAbsenceType::ABSENCE_TYPE_HOLIDAY ? TRUE : FALSE,
            ];
        }
        $service = (new MonthlyHoursOverviewReportService($this->month, $this->year))->setSpecificWorkers($this->worker->id)->execute();
        $response = $service->getResponse()['data'];
        foreach ($response as $data) {
            $output['report'] = $data;
        }
        $this->setData($output);
        return $this;
    }
}

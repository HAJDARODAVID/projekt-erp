<?php

namespace App\Services\WorkdayDiary;

use App\Models\CompanyCarsModel;
use App\Models\ConstructionSiteModel;
use App\Models\User;
use App\Models\WorkingDayLogModel;
use App\Models\WorkingDayRecordModel;
use App\Services\Attendance\GetAttendanceService;
use App\Services\Attendance\RemoveAttendanceService;
use Illuminate\Support\Facades\Auth;

/**
 * Class DeleteWorkdayDiaryService.
 */
class DeleteWorkdayDiaryService
{
    /**
     * @var WorkingDayRecordModel
     */
    private $workDayDiary = NULL;

    public function __construct($wddID)
    {
        $this->workDayDiary = WorkingDayRecordModel::find($wddID);
    }

    /**
     * The keepAttendance argument gives the RemoveAttendanceService the flag if to delete or keep the data.
     * By default the keepAttendance is set to FALSE, so the attendance will be deleted.
     */
    public function execute($keepAttendance = FALSE)
    {
        if ($this->workDayDiary == NULL) return ['success' => false, 'error' => 'There is no work diary with given ID!'];

        /**
         * Alter the attendance
         */
        $attendanceService = GetAttendanceService::byWdr($this->workDayDiary->id);
        /**Go thru my workers and alter the attendance */
        $myWorkersAttendance = $attendanceService->getMyWorkerAttendance();
        foreach ($myWorkersAttendance as $att) {
            dd($att);
            //$attendanceService = RemoveAttendanceService::myWorker()
        }

        /**Go thru cooperators and alter the attendance */
        $cooperatorsAttendance = $attendanceService->getCooperatorAttendance();
        foreach ($cooperatorsAttendance as $att) {
            $removeAttendanceService = RemoveAttendanceService::cooperator($att->id);
            if ($keepAttendance) $removeAttendanceService->removeOnlyFromWdr();
            //dd($removeAttendanceService);
            $removeAttendanceService->execute();
        }
        dd($attendanceService);
    }
}

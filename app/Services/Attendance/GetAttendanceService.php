<?php

namespace App\Services\Attendance;

use App\Models\AttendanceCoOpModel;
use App\Models\AttendanceModel;
use App\Models\CooperatorWorkersModel;
use App\Models\WorkerModel;

/**
 * Class CreateAttendanceService.php.
 */
class GetAttendanceService
{
    const MY_WORKER_TYPE = 'myWorker';
    const COOPERATOR_TYPE = 'cooperator';
    const AVAILABLE_TYPES = ['myWorker', 'cooperator'];

    private $myWorkerAttendance   = NULL;
    private $cooperatorAttendance = NULL;


    public function __construct($type, $param)
    {
        switch ($type) {
            case 'byConstructionSite':
                $this->setAttendanceByConstructionSite($param);
                break;
            case 'byWdr':
                $this->setAttendanceByWdr($param);
                break;

            default:
                # code...
                break;
        }
    }

    public static function byConstructionSite($id) {}

    public static function byWdr($id)
    {
        return new self('byWdr', $id);
    }

    //TODO: dok tu bude trebalo za sve WDR uzeti od tog gradilišta
    private function setAttendanceByConstructionSite($id)
    {
        return;
    }

    private function setAttendanceByWdr($param)
    {
        $this->myWorkerAttendance = AttendanceModel::where('working_day_record_id', $param)->get();
        $this->cooperatorAttendance = AttendanceCoOpModel::where('working_day_record_id', $param)->get();
    }

    public function execute()
    {
        dd($this);
    }

    public function getMyWorkerAttendance()
    {
        return $this->myWorkerAttendance;
    }

    public function getCooperatorAttendance()
    {
        return $this->cooperatorAttendance;
    }

    /**
     * Alter the attendance data for the edit attendance component.
     */
    public function createDataForEditAttendanceComponent()
    {
        $myWorkersArray = [];
        $cooperatorsArray = [];
        foreach ($this->myWorkerAttendance as $att) {
            if ($att->work_hours != NULL) {
                $worker = WorkerModel::find($att->worker_id);
                $myWorkersArray[$worker->id] = [
                    'att_id' => $att->id,
                    'name' => $worker->fullName,
                    'att_time' => $att->work_hours
                ];
            }
        }
        foreach ($this->cooperatorAttendance as $att) {
            if ($att->work_hours != NULL) {
                $worker = CooperatorWorkersModel::with('getCoOpInfo')->find($att->worker_id);
                $cooperatorsArray[$worker->id] = [
                    'att_id' => $att->id,
                    'name' => $worker->fullName . '-' . $worker->getCoOpInfo->name,
                    'att_time' => $att->work_hours
                ];
            }
        }
        $this->myWorkerAttendance = $myWorkersArray;
        $this->cooperatorAttendance = $cooperatorsArray;
        return $this;
    }
}

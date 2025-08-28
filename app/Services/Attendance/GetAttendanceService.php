<?php

namespace App\Services\Attendance;

use App\Models\AttendanceCoOpModel;
use App\Models\AttendanceModel;

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
}

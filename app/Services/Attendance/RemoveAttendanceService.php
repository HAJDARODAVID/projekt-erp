<?php

namespace App\Services\Attendance;

use App\Models\AttendanceCoOpModel;
use App\Models\AttendanceModel;

/**
 * Class CreateAttendanceService.php.
 */
class RemoveAttendanceService
{
    const MY_WORKER_TYPE = 'myWorker';
    const COOPERATOR_TYPE = 'cooperator';
    const AVAILABLE_TYPES = ['myWorker', 'cooperator'];

    private $id;
    private $attendanceModel;

    /**
     * - remove from wdr --> 1
     */
    private $flag = NULL;

    public function __construct($id, $for)
    {
        $this->id = $id;
        switch ($for) {
            case 'myWorker':
                $this->attendanceModel = AttendanceModel::find($id);
                break;
            case 'cooperator':
                $this->attendanceModel = AttendanceCoOpModel::find($id);
                break;
        }
    }

    public static function myWorker($id)
    {

        return new self($id, self::MY_WORKER_TYPE);
    }

    public static function cooperator($id)
    {
        return new self($id, self::COOPERATOR_TYPE);
    }

    /**
     * This will add a flag to remove only the wdr from the attendance
     */
    public function removeOnlyFromWdr()
    {
        $this->flag = 1;
        return $this;
    }

    public function execute()
    {
        /**Check if there is a attendance record */
        if ($this->attendanceModel == NULL) return ['success' => FALSE, 'error' => "Ne postoji zapis prisustva sa ID:" . $this->id . "!"];

        /**Check if a flag is set */
        if ($this->flag) {
            switch ($this->flag) {
                case 1:
                    $this->attendanceModel->update(['working_day_record_id' => NULL]);
                    break;
            }
        } else {
            $this->attendanceModel->delete();
        }
        return ['success' => TRUE];
    }
}

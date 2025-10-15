<?php

namespace App\Services\Attendance;

use App\Models\AttendanceCoOpModel;
use App\Models\AttendanceModel;

/**
 * Class EditAttendanceService.php.
 */
class EditAttendanceService
{
    const MY_WORKER_TYPE = 'myWorker';
    const COOPERATOR_TYPE = 'cooperator';
    const AVAILABLE_TYPES = ['myWorker', 'cooperator'];

    private $id;
    private $attendanceModel;

    private $workerID      = NULL;
    private $diaryID       = NULL;
    private $type          = NULL;
    private $workHours     = NULL;
    private $absenceReason = NULL;
    private $date          = NULL;

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
     * Set and save only the attendance model date.
     * 
     * @return void
     */
    public function changeDate($date): void
    {
        $this->attendanceModel->date = $date;
        $this->attendanceModel->save();
        return;
    }

    /**
     * Set and save only the attendance model type.
     * 
     * @return void
     */
    public function changeType($type): void
    {
        $this->attendanceModel->type = $type;
        $this->attendanceModel->save();
        return;
    }

    /**
     * Get the value of workerID
     */
    public function getWorkerID()
    {
        return $this->workerID;
    }

    /**
     * Set the value of workerID
     *
     * @return  self
     */
    public function setWorkerID($workerID)
    {
        $this->workerID = $workerID;

        return $this;
    }

    /**
     * Get the value of diaryID
     */
    public function getDiaryID()
    {
        return $this->diaryID;
    }

    /**
     * Set the value of diaryID
     *
     * @return  self
     */
    public function setDiaryID($diaryID)
    {
        $this->diaryID = $diaryID;

        return $this;
    }

    /**
     * Get the value of type
     */
    public function getType()
    {
        return $this->type;
    }

    /**
     * Set the value of type
     *
     * @return  self
     */
    public function setType($type)
    {
        $this->type = $type;

        return $this;
    }

    /**
     * Get the value of workHours
     */
    public function getWorkHours()
    {
        return $this->workHours;
    }

    /**
     * Set the value of workHours
     *
     * @return  self
     */
    public function setWorkHours($workHours)
    {
        $this->workHours = $workHours;

        return $this;
    }

    /**
     * Get the value of absenceReason
     */
    public function getAbsenceReason()
    {
        return $this->absenceReason;
    }

    /**
     * Set the value of absenceReason
     *
     * @return  self
     */
    public function setAbsenceReason($absenceReason)
    {
        $this->absenceReason = $absenceReason;

        return $this;
    }

    /**
     * Get the value of date
     */
    public function getDate()
    {
        return $this->date;
    }

    /**
     * Set the value of date
     *
     * @return  self
     */
    public function setDate($date)
    {
        $this->date = $date;

        return $this;
    }
}

<?php

namespace App\Services\Attendance;

use App\Models\Employees\Attendance;
use App\Models\Employees\AttendanceAbsenceType;
use App\Models\Employees\Worker;
use App\Models\Employees\WorkerStatus;
use DateTime;
use App\Services\BaseService;

/**
 * Class MassAbsenceAssignmentService.
 */
class MassAbsenceAssignmentService extends BaseService
{
    /**
     * Executes the service.
     * 
     * @param DateTime $date The date for which to set the absence.
     * @param array $workers All the workers to apply the absence.
     * @param AttendanceAbsenceType $typeCode Absence object.
     * 
     * @return self
     */
    public function execute(DateTime $date, array $workers, AttendanceAbsenceType $typeCode): self
    {
        try {
            foreach ($workers as $workerID => $worker) {
                /**Check if the worker is active | if not get to next iteration */
                if (!(WorkerStatus::setByStatus($worker['status'])->isActive())) continue;

                /**Check if there are attendance records | if yes get to next iteration  */
                $attObj = Attendance::where('worker_id', $workerID)->where('date', $date->format('Y-m-d'))->get();
                if ($attObj->count() > 0) continue;

                CreateAttendanceService::myWorker()
                    ->setWorkerID($workerID)
                    ->setAbsenceReason($typeCode->code())
                    ->setDate($date->format('Y-m-d'))
                    ->execute();
            }
        } catch (\Throwable $th) {
            $this->setErrorMessage($th->getMessage());
        }
        $this->setSuccessMessage('New absence set!');
        return $this;
    }
}

<?php

namespace App\Services\HidroProjekt\Domain\Subcontractors;

use App\Models\CooperatorsModel;
use App\Models\CooperatorWorkersModel;

/**
 * Class SubcontractorsService.
 */
class SubcontractorsService
{
    private $workers;
    private $groups;
    private $groupStatus = 'all';
    private $workerStatus = 'all';

    public function __construct()
    {
        $this->workers = new CooperatorWorkersModel;
        $this->groups = new CooperatorsModel;
    }

    public function setActiveWorkers(){
        $this->workers=$this->workers->where('status', CooperatorWorkersModel::COOPERATORS_WORKER_STATUS_ACTIVE);
        return $this;
    }

    public function setActiveGroups(){
        $this->groups=$this->groups->where('status', CooperatorsModel::COOPERATORS_STATUS_ACTIVE);
        return $this;
    }

    public function getWorkers(){
        return $this->workers->get();
    }

    public function getGroups(){
        return $this->groups->get();
    }

    public function getBdeArray($wdrID){
        $groups = $this->getGroups();
        $workers = $this->getWorkers();
        $array=[];
        foreach ($groups as $group) {
            foreach ($workers as $worker) {
                $attendanceService = new SubcontractorsAttendanceService($wdrID,$worker->id);
                if($worker->cooperator_id == $group->id){
                    $workerHours = $attendanceService->getAttendanceForWorkDayAndWorker();
                    $array[$group->name][$worker->id] = [
                        'name' => $worker->firstName . ' ' . $worker->lastName,
                        'hours' => $workerHours == NULL ? NULL : $workerHours->work_hours,
                    ];
                }
            }
        }
        return $array;
    }

}

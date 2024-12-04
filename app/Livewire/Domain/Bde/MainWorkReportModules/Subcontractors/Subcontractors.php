<?php

namespace App\Livewire\Domain\Bde\MainWorkReportModules\Subcontractors;

use Livewire\Component;
use App\Services\HidroProjekt\Domain\Subcontractors\SubcontractorsService;
use App\Services\HidroProjekt\Domain\Subcontractors\SubcontractorsAttendanceService;

class Subcontractors extends Component
{
    public $wdr;
    public $subcontractors;

    public $saveState = [];

    public function mount(){
        $service = new SubcontractorsService();
        $this->subcontractors = $service->setActiveWorkers()->setActiveGroups()->getBdeArray($this->wdr['id']);
    }
    
    public function updatedSubcontractors($key, $value){
        $this->reset('saveState');
        list($group, $workerID, $col) = explode('.', $value);
        $attendanceService = new SubcontractorsAttendanceService($this->wdr['id'],$workerID);
        $attendanceService->getAttendanceForWorkDayAndWorker(false)->setAttendance($key);
        $this->saveState[$workerID] = TRUE; 
    }

    public function removeAttendance($workerID = NULL, $group = NULL){
        $this->reset('saveState');
        $attendanceService = new SubcontractorsAttendanceService($this->wdr['id'],$workerID);
        if($attendanceService->getAttendanceForWorkDayAndWorker(FALSE)->hasAttendance()){
            $attendanceService->removeAttendance();
            $this->subcontractors[$group][$workerID]['hours'] = NULL;
        }
        $this->saveState[$workerID] = TRUE; 
        return;
    }

    public function render()
    {
        return view('livewire.domain.bde.main-work-report-modules.subcontractors.subcontractors');
    }
}

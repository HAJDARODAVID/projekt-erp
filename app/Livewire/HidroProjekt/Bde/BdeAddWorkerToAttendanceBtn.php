<?php

namespace App\Livewire\HidroProjekt\Bde;

use App\Services\HidroProjekt\BDE\WorkerAttendanceService;
use Livewire\Component;

class BdeAddWorkerToAttendanceBtn extends Component
{
    public $worker;
    public $workingDayEntry;
    public $showBtn;

    public function mount(){
        $this->setShowBtn();
    }

    public function addWorkerToAttendance(){
        WorkerAttendanceService::setWorkerAttendance($this->worker,$this->workingDayEntry);
        $this->showBtn = false;
        $this->dispatch('refreshWorkersInAttendanceTable')->to(BdeWorkersInAttendanceTable::class);
    }

    public function render()
    {
        return view('livewire.hidroprojekt.bde.bde-add-worker-to-attendance-btn');
    }

    private function setShowBtn(){
        $attendance = WorkerAttendanceService::getWorkerAttendanceForEntry($this->worker,$this->workingDayEntry);
        if(!is_null($attendance)){
            $this->showBtn = false;
        }else{
            $this->showBtn = true;
        }
    }
}

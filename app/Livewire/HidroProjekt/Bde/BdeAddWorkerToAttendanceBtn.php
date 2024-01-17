<?php

namespace App\Livewire\HidroProjekt\Bde;

use App\Services\HidroProjekt\BDE\WorkerAttendanceService;
use Livewire\Component;

class BdeAddWorkerToAttendanceBtn extends Component
{
    public $worker;
    public $workingDayEntry;
    public $showBtn = true;

    public function mount(){

    }

    public function addWorkerToAttendance(){
        WorkerAttendanceService::setWorkerAttendance($this->worker,$this->workingDayEntry);
        $this->showBtn = false;
    }

    public function render()
    {
        return view('livewire.hidroprojekt.bde.bde-add-worker-to-attendance-btn');
    }
}

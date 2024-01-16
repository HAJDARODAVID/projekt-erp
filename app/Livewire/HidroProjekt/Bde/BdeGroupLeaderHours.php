<?php

namespace App\Livewire\HidroProjekt\Bde;

use Livewire\Component;
use Illuminate\Support\Facades\Auth;
use App\Services\HidroProjekt\BDE\WorkerAttendanceService;

class BdeGroupLeaderHours extends Component
{   
    public $record;
    public $workHours;

    public function mount(){
        $this->workHours = $this->setHours();
    }

    public function updatedWorkHours(){
        WorkerAttendanceService::setWorkerAttendance(Auth::user()->id,$this->record,$this->workHours);
    }

    public function render()
    {
        return view('livewire.hidroprojekt.bde.bde-group-leader-hours');
    }

    private function setHours(){
        $attendance = WorkerAttendanceService::getAttendanceForWorkingDayEntry(Auth::user()->id,$this->record->id);
        if(is_null($attendance)){
            return $this->workHours = NULL;
        }else{
            return $this->workHours = $attendance->work_hours;
        }
    }
}

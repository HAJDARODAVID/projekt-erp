<?php

namespace App\Livewire\HidroProjekt\Hr;

use App\Models\AttendanceModel;
use App\Services\HidroProjekt\HR\AttendanceService;
use Livewire\Component;

class AddSickLeaveToAttendance extends Component
{
    public $dates=[];
    public $worker;

    public function mount(){
        $this->dates=[
            'startDate' => date("Y-m-d"),
            'endDate' => date("Y-m-d"),
        ];
    }

    public function createNewSickLeave(){
        $service = new AttendanceService;
        $service->setAbsenceReasonToAttendance([
            'dates' => $this->dates,
            'worker' => $this->worker,
            'type' => AttendanceModel::ABSENCE_REASON_SICK_LEAVE,
        ]);
        return redirect()->route('hp_workerWorkHours', $this->worker);
    }
    public function render()
    {
        return view('livewire.hidroprojekt.hr.add-sick-leave-to-attendance');
    }
}

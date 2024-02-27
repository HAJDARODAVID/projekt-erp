<?php

namespace App\Livewire\HidroProjekt\Hr;

use Livewire\Component;
use App\Models\AttendanceModel;
use App\Services\HidroProjekt\HR\AttendanceService;

class AddPaidLeaveToAttendance extends Component
{
    public $dates=[];
    public $worker;

    public function mount(){
        $this->dates=[
            'startDate' => date("Y-m-d"),
            'endDate' => date("Y-m-d"),
        ];
    }

    public function createNewPaidLeave(){
        $service = new AttendanceService;
        $service->setAbsenceReasonToAttendance([
            'dates' => $this->dates,
            'worker' => $this->worker,
            'type' => AttendanceModel::ABSENCE_REASON_PAID_LEAVE,
        ]);
        return redirect()->route('hp_workerWorkHours', $this->worker);
    }

    public function updatedDates($key, $value){
        if($value == 'startDate'){
            $this->dates['endDate'] = $key;
        }
        if($value == 'endDate'){
            if ($key < $this->dates['startDate'] ) {
                $this->dates['startDate'] = $key;
            }
            return;
        }
    }

    public function render()
    {
        return view('livewire.hidroprojekt.hr.add-paid-leave-to-attendance');
    }
}

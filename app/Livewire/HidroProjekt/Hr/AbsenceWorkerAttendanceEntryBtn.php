<?php

namespace App\Livewire\HidroProjekt\Hr;

use App\Models\AttendanceModel;
use Livewire\Component;

class AbsenceWorkerAttendanceEntryBtn extends Component
{
    public $row;
    public $sickLeave = AttendanceModel::ABSENCE_REASON_SICK_LEAVE;
    public $paidLeave = AttendanceModel::ABSENCE_REASON_PAID_LEAVE;

    public function updateAbsenceReason($reason){
        $worker = $this->row->worker_id;
        $this->row->update([
            'work_hours' => NULL,
            'absence_reason' => $reason,
        ]);
        return redirect()->route('hp_workerWorkHours',$worker);
    }
    public function render()
    {
        return view('livewire.hidroprojekt.hr.absence-worker-attendance-entry-btn');
    }
}

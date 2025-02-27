<?php

namespace App\Livewire\Domain\Attendance;

use Livewire\Component;
use App\Models\AttendanceModel;
use App\Models\AttendanceCoOpModel;
use Livewire\Attributes\On;

class AttendanceTableForDailyReport extends Component
{
    /**
     * Daily work report object
     */
    public $wdr;

    /**
     * All the attendance data for this report.
     * Only Hidro-Projekt employees
     */
    public $attendance;

    /**
     * All the attendance data for this report.
     * Only CoOperator employees
     */
    public $attendanceCoOp;

    public function mount(){
        $this->setAttendance();
    }

    /**
     * Set the properties with data.
     * Gets the data for this report 
     */
    #[On('refresh-attendance-table-for-daily-report')]
    public function setAttendance(){
        $this->attendance = AttendanceModel::where('working_day_record_id', $this->wdr->id)->with('getWorkerInfo')->get();
        $this->attendanceCoOp = AttendanceCoOpModel::where('working_day_record_id', $this->wdr->id)->where('work_hours', '!=', NULL)->with('getWorkerInfo', 'getWorkerInfo.getCoOpInfo')->get();
    }

    public function render()
    {
        return view('livewire.domain.attendance.attendance-table-for-daily-report');
    }
}

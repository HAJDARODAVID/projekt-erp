<?php

namespace App\Livewire\HidroProjekt\Hr;

use Livewire\Component;
use App\Services\Months;
use Livewire\Attributes\On; 
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\Adm\AttendanceReportExport;
use App\Services\HidroProjekt\HR\AttendanceService;
use App\Services\HidroProjekt\HR\WorkHoursService;

class WorkHoursReport extends Component
{
    public $months = Months::MONTHS_HR;
    public $selectedMonth;
    public $daysOfMonth;
    public $completeAttendance;
    public $daySum;
    public $planedHours;
    public $attendanceReport;
    public $cumulative;

    #[On('refreshWorkHoursComponentHPWorker')] 
    public function mount(){
        $this->daysOfMonth=Months::dayOfMonth($this->selectedMonth);
        $this->planedHours = WorkHoursService::getPlanedHoursForMonth($this->selectedMonth);
        $this->attendanceReport = WorkHoursService::getAllAttendanceForMonthReport($this->selectedMonth, $this->planedHours);
        $this->completeAttendance= $this->attendanceReport['attendance'];
        $this->cumulative = $this->attendanceReport['cumulative']; 
    }
    public function updatedSelectedMonth(){
        $this->dispatch('refreshWorkHoursComponentHPWorker')->self();
    }

    public function exportAttendanceReport(){
        $service = new AttendanceService;
        $data['summary']=$service->getDataForWorkerAttendanceReport($this->selectedMonth);
        $data['per_day']=$service->getAllAttendanceDataForMonthly($this->selectedMonth);
        $data['month'] = $this->selectedMonth;
        return (new AttendanceReportExport($data));
    }

    public function openAttendanceModalForWorkerAndDay($workerId=NULL, $date=NULL){
        $this->dispatch('open-worker-attendance-modal', $data=[
            'workerId' => $workerId,
            'date' => $date,
        ]);
    }

    public function render()
    {
        return view('livewire.hidroprojekt.hr.work-hours-report');
    }
}

<?php

namespace App\Livewire\HidroProjekt\Hr;

use App\Services\HidroProjekt\HR\WorkHoursService;
use App\Services\Months;
use Livewire\Component;
use Livewire\Attributes\On; 

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

    #[On('refreshWorkHoursComponent')] 
    public function mount(){
        $this->daysOfMonth=Months::dayOfMonth($this->selectedMonth);
        $this->planedHours = WorkHoursService::getPlanedHoursForMonth($this->selectedMonth);
        $this->attendanceReport = WorkHoursService::getAllAttendanceForMonthReport($this->selectedMonth, $this->planedHours);
        $this->completeAttendance= $this->attendanceReport['attendance'];
        $this->cumulative = $this->attendanceReport['cumulative']; 
    }
    public function updatedSelectedMonth(){
        $this->dispatch('refreshWorkHoursComponent')->self();

    }

    public function render()
    {
        return view('livewire.hidroprojekt.hr.work-hours-report');
    }
}

<?php

namespace App\Livewire\HidroProjekt\Hr;

use App\Services\HidroProjekt\HR\WorkHoursService;
use Livewire\Component;
use App\Services\Months;
use Livewire\Attributes\On; 

class WorkHoursCoOpReport extends Component
{
    public $selectedYear;
    public $selectedMonth;
    public $months = Months::MONTHS_HR;
    public $daysOfMonth;
    public $attendance;

    #[On('refreshWorkHoursComponent')] 
    public function mount(){
        $this->daysOfMonth=Months::dayOfMonth($this->selectedMonth, $this->selectedYear);
        $this->attendance = WorkHoursService::getAllAttendanceForMonthReportCoOp($this->selectedMonth, $this->selectedYear,$this->daysOfMonth);
    }

    public function updatedSelectedMonth(){
        $this->dispatch('refreshWorkHoursComponent')->self();
    }

    public function updatedSelectedYear(){
        $this->dispatch('refreshWorkHoursComponent')->self();
    }

    public function render()
    {
        return view('livewire.hidroprojekt.hr.work-hours-co-op-report');
    }
}

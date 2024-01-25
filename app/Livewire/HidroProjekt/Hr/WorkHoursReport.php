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

    #[On('refreshWorkHoursComponent')] 
    public function mount(){
        $this->daysOfMonth=Months::dayOfMonth($this->selectedMonth);
        $this->completeAttendance=WorkHoursService::getAllAttendanceForMonth($this->selectedMonth);
    }
    public function updatedSelectedMonth(){
        $this->dispatch('refreshWorkHoursComponent')->self();

    }

    public function render()
    {
        return view('livewire.hidroprojekt.hr.work-hours-report');
    }
}

<?php

namespace App\Livewire\HidroProjekt\Hr;

use Livewire\Component;
use App\Services\Months;
use Livewire\Attributes\On; 
use App\Services\HidroProjekt\HR\WorkHoursService;
use App\Livewire\HidroProjekt\Hr\CoOpWorkHoursExportModal;
use App\Services\Years;

class WorkHoursCoOpReport extends Component
{
    public $selectedYear;
    public $selectedMonth;
    public $months = Months::MONTHS_HR;
    public $years;
    public $daysOfMonth;
    public $attendance;

    #[On('refreshWorkHoursComponent')] 
    public function mount(){
        $this->years = Years::getYearsList();
        $this->daysOfMonth=Months::dayOfMonth($this->selectedMonth, $this->selectedYear);
        $this->attendance = WorkHoursService::getAllAttendanceForMonthReportCoOp($this->selectedMonth, $this->selectedYear,$this->daysOfMonth);

        //dd( $this->attendance);
    }

    public function openAttendanceModalForWorkerAndDay($workerId=NULL, $date=NULL){
        $this->dispatch('open-co-op-attendance-modal', $data=[
            'workerId' => $workerId,
            'date' => $date,
        ]);
    }

    public function updatedSelectedMonth(){
        $this->dispatch('refreshWorkHoursComponent')->self();
    }

    public function updatedSelectedYear(){
        $this->dispatch('refreshWorkHoursComponent')->self();
    }

    public function render()
    {
        return view('livewire.hidroprojekt.hr.work-hours-co-op-report',[
            's_year' => $this->selectedYear,
            's_month' => $this->selectedMonth,
        ]);
    }
}

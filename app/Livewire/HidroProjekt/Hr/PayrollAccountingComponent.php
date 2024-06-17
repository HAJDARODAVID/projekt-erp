<?php

namespace App\Livewire\HidroProjekt\Hr;

use Livewire\Component;
use App\Services\Months;
use Livewire\Attributes\Url;

class PayrollAccountingComponent extends Component
{
    public $allMonths = Months::MONTHS_HR;

    #[Url] 
    public $year;

    #[Url] 
    public $month;

    public function mount(){
    }

    public function getPayrollAccountingData(){

    }
    
    public function render()
    {
        return view('livewire.hidroprojekt.hr.payroll-accounting-component');
    }
}

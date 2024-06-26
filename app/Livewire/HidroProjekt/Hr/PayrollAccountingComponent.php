<?php

namespace App\Livewire\HidroProjekt\Hr;

use App\Services\HidroProjekt\ADM\PayrollAccountingService;
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

    public $data;
    public $bonus;
    public $fieldValues=[];

    public function mount(){
        if($this->month && $this->year){
            $this->getPayrollAccountingData();
        }
    }

    public function getPayrollAccountingData(){
        $service = new PayrollAccountingService($this->month, $this->year);
        $this->bonus = $service->bonus;
        $this->fieldValues = [
            'home'  => $service->field_1,
            'field' => $service->field_2,
        ];
        return $this->data = $service->data;
    }
    
    public function render()
    {
        return view('livewire.hidroprojekt.hr.payroll-accounting-component');
    }
}

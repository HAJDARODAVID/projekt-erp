<?php

namespace App\Livewire\HidroProjekt\Hr;

use App\Services\HidroProjekt\ADM\PayrollAccountingService;
use Livewire\Component;
use App\Services\Months;
use Exception;
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
        $this->data = $service->data;
        $this->formateNumbers();
        //dd(var_dump($service->data[1]['pay_out']));
        return;
    }

    public function updated($key, $value){
        extract($this->getArrayFromUpdatedKey($key));
        $methodName='updating'.ucfirst($cName).'';
        try {
            $this->$methodName();
        } catch (Exception $e) {
            return $this->dispatch('show-exception-modal',$e->getMessage());
        }
    }

    private function updatingH_rate($key=NULL, $value=NULL){
        dd('im in madafaka');
    }

    protected function getArrayFromUpdatedKey($key){
        list($property, $worker, $cName) = explode('.', $key);
        return $array = [
            'property' => $property,
            'worker'   => $worker,
            'cName'    => $cName
        ];
    }

    private function formateNumbers():void{
        foreach ($this->data as $id => $worker) {
            foreach ($worker as $key => $value) {
                if(is_float($value)){
                    $this->data[$id][$key] = number_format($value, 2);
                }
            }
        }
    }
    
    public function render()
    {
        return view('livewire.hidroprojekt.hr.payroll-accounting-component');
    }
}

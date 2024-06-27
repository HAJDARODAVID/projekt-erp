<?php

namespace App\Livewire\HidroProjekt\Hr;

use App\Services\HidroProjekt\ADM\PayrollAccountingService;
use Livewire\Component;
use App\Services\Months;
use Exception;
use Livewire\Attributes\Url;
use Livewire\Attributes\On;

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
    protected $oldValue;

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
        return;
    }

    public function updating($key, $value){
        extract($this->getArrayFromUpdatedKey($key));
        $this->oldValue = (float)$this->data[$worker][$cName];
    }

    public function updated($key, $value){
        extract($this->getArrayFromUpdatedKey($key));
        $this->data[$worker][$cName] = number_format((float)$value,2,thousands_separator:'', decimal_separator:'.');
        $methodName='updating'.ucfirst($cName).'';
        try {
            $this->$methodName($key, $value);
        } catch (Exception $e) {
            $this->data[$worker][$cName] = number_format($this->oldValue,2,thousands_separator:'', decimal_separator:'.');
            return $this->dispatch('show-exception-modal',$e->getMessage());
        }
    }

    #[On('h-rate-confirmation')]
    public function updatingH_rate($key=NULL, $value=NULL, $confirmation=FALSE, $worker=NULL){
        if($confirmation){
            return $this->recalculateForWorker($worker);
        }
        extract($this->getArrayFromUpdatedKey($key));
        $this->dispatch('open-change-worker-h-rate', [
            'workerId' => $worker,
            'newValue' => (float)$value,
        ]);
        return;
    }

    protected function updatingBonus($key=NULL, $value=NULL){
        extract($this->getArrayFromUpdatedKey($key));
        return $this->recalculateForWorker($worker);
    }

    protected function updatingTravel_exp($key=NULL, $value=NULL){
        extract($this->getArrayFromUpdatedKey($key));
        return $this->recalculateForWorker($worker);
    }

    protected function updatingPhone_exp($key=NULL, $value=NULL){
        extract($this->getArrayFromUpdatedKey($key));
        return $this->recalculateForWorker($worker);
    }

    protected function getArrayFromUpdatedKey($key){
        list($property, $worker, $cName) = explode('.', $key);
        return $array = [
            'property' => $property,
            'worker'   => $worker,
            'cName'    => $cName
        ];
    }

    protected function recalculateForWorker($id){
        // $wd short for workerData
        $wd = $this->data[$id];
        if($wd['fix_rate']){
            $this->data[$id]['base'] = $wd['fix_rate'];
        }else{
            $this->data[$id]['base'] = $wd['hours'] * $wd['h_rate']; 
        }
        $this->data[$id]['pay_out'] = (float)$this->data[$id]['base'] + (float)$wd['bonus_field_1'] + (float)$wd['bonus_field_2'] +(float)$wd['bonus']+(float)$wd['travel_exp']+(float)$wd['phone_exp'];
        $this->formateNumbers($id);
        return;
    }

    private function formateNumbers($wId=null):void{
        if($wId){
            foreach ($this->data[$wId] as $key => $value) {
                if(is_float($value)){
                    $this->data[$wId][$key] = number_format($value, 2,thousands_separator:'', decimal_separator:'.');
                }
            }
        }
        foreach ($this->data as $id => $worker) {
            foreach ($worker as $key => $value) {
                if(is_float($value)){
                    $this->data[$id][$key] = number_format($value, 2,thousands_separator:'', decimal_separator:'.');
                }
            }
        }
    }
    
    public function render()
    {
        return view('livewire.hidroprojekt.hr.payroll-accounting-component');
    }
}

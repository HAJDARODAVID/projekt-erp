<?php

namespace App\Livewire;

use Exception;
use Livewire\Component;
use App\Exceptions\MissingMethodException;

class PercentageCalculator extends Component
{
    public $type;
    public $percentageType = 'add';
    public $amount = [];
    public $percentage = 3;
    public $text = [];
    public $newStyle = 0;
    public $data =[];

    public function mount(){
        $this->setText();
    }

    public function updatedAmountAmount1($key){
        if($key != ""){
            $this->calculate();
        }else{
            $this->amount['amount1'] = 0;
            $this->amount['amount2'] = 0;
        } 
    }

    public function updatedPercentageType(){
        $this->calculate();
    }

    public function updatedPercentage($key){
        if($key != ""){
            $this->calculate();
        }else{
            $this->amount['amount1'] = 0;
            $this->amount['amount2'] = 0;
            $this->percentage = 3;
        }     
    }

    private function getPercentageValue(){
        if($this->percentageType == 'add'){
            return $this->amount['amount2'] = $this->amount['amount1'] * (1 + $this->percentage/100);
        }
        if($this->percentageType == 'deduct'){
           return  $this->amount['amount2'] = $this->amount['amount1'] * (1 - $this->percentage/100);
        }
        return;
    }

    public function calculate(){
        if($this->type == 'add'){
            $this->getPercentageValue();
        }
        if($this->type == 'remove'){
           return  $this->amount['amount2'] = $this->amount['amount1'] * ($this->percentage/100);
        }
        return;
    }

    private function setText(){
        if($this->type == 'add'){
            return $this->text['text01'] = 'Uvečaj/smanji';
        }
        if($this->type == 'remove'){
            return $this->text['text01'] = '%:';
        }
        return;
    }

    //New style functions

    public function updatedData($value, $key){
        if(strpos($key, '.')){
            list($key, $property) = explode('.', $key);
        }
        try {
            if(!method_exists(get_class($this),'set'.ucfirst($key))){
                throw new MissingMethodException('set'.ucfirst($key));
            }
            $method = 'set'.ucfirst($key);
            $this->$method();
        } catch (Exception $e) {
            return $this->dispatch('show-exception-modal',$e->getMessage());
        }
    }

    private function setPercentageOfAmount(){
        $arrayKey = 'percentageOfAmount';
        if(isset($this->data[$arrayKey]['percentage']) && isset($this->data[$arrayKey]['amount'])){
            if(!$this->data[$arrayKey]['percentage'] || !$this->data[$arrayKey]['amount']){
                return $this->data[$arrayKey]['result'] = NULL;
            }
            return $this->data[$arrayKey]['result'] = $this->data[$arrayKey]['amount'] * ($this->data[$arrayKey]['percentage'] / 100);
        }
        return $this->data[$arrayKey]['result'] = NULL;
    }

    private function setPercentageFromAmount(){
        $arrayKey = 'percentageFromAmount';
        if(isset($this->data[$arrayKey]['amountI']) && isset($this->data[$arrayKey]['amountII'])){
            if(!$this->data[$arrayKey]['amountI'] || !$this->data[$arrayKey]['amountII']){
                return $this->data[$arrayKey]['result'] = NULL;
            }
            return $this->data[$arrayKey]['result'] = ($this->data[$arrayKey]['amountI'] / $this->data[$arrayKey]['amountII'])*100;
        }
        return $this->data[$arrayKey]['result'] = NULL;
    }

    private function setAmountFromPercentage(){
        $arrayKey = 'amountFromPercentage';
        if(isset($this->data[$arrayKey]['amount']) && isset($this->data[$arrayKey]['percentage'])){
            if(!$this->data[$arrayKey]['amount'] || !$this->data[$arrayKey]['percentage']){
                return $this->data[$arrayKey]['result'] = NULL;
            }
            return $this->data[$arrayKey]['result'] = $this->data[$arrayKey]['amount'] / ($this->data[$arrayKey]['percentage'] / 100);
        }
        return $this->data[$arrayKey]['result'] = NULL;
    }

    private function setEnlargeAmountForPercentage(){
        $arrayKey = 'enlargeAmountForPercentage';
        if(isset($this->data[$arrayKey]['amount']) && isset($this->data[$arrayKey]['percentage'])){
            if(!$this->data[$arrayKey]['amount'] || !$this->data[$arrayKey]['percentage']){
                return $this->data[$arrayKey]['result'] = NULL;
            }
            return $this->data[$arrayKey]['result'] = $this->data[$arrayKey]['amount'] * (1+($this->data[$arrayKey]['percentage'] / 100));
        }
        return $this->data[$arrayKey]['result'] = NULL;
    }

    private function setDecreaseAmountForPercentage(){
        $arrayKey = 'decreaseAmountForPercentage';
        if(isset($this->data[$arrayKey]['amount']) && isset($this->data[$arrayKey]['percentage'])){
            if(!$this->data[$arrayKey]['amount'] || !$this->data[$arrayKey]['percentage']){
                return $this->data[$arrayKey]['result'] = NULL;
            }
            return $this->data[$arrayKey]['result'] = $this->data[$arrayKey]['amount'] * (1-($this->data[$arrayKey]['percentage'] / 100));
        }
        return $this->data[$arrayKey]['result'] = NULL;
    }

    public function render()
    {
        return view('livewire.percentage-calculator');
    }
}

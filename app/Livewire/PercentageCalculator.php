<?php

namespace App\Livewire;

use Livewire\Component;

class PercentageCalculator extends Component
{
    public $type;
    public $percentageType = 'add';
    public $amount = [];
    public $percentage = 3;
    public $text = [];

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

    public function render()
    {
        return view('livewire.percentage-calculator');
    }
}

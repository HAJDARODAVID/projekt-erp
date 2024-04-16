<?php

namespace App\Livewire;

use Livewire\Component;

class PercentageCalculator extends Component
{
    public $type;
    public $amount = [];
    public $percentage = 3;

    public function updatedAmountAmount1($key){
        if($key != ""){
            $this->calculate();
        }else{
            $this->amount['amount1'] = 0;
            $this->amount['amount2'] = 0;
        } 
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


    public function calculate(){
        if($this->type == 'add'){
            return $this->amount['amount2'] = $this->amount['amount1'] * (1 + $this->percentage/100);
        }
        if($this->type == 'remove'){
           return  $this->amount['amount2'] = $this->amount['amount1'] * (1 - $this->percentage/100);;
        }
        return;
    }

    public function render()
    {
        return view('livewire.percentage-calculator');
    }
}

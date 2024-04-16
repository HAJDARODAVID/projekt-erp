<?php

namespace App\Livewire;

use Livewire\Component;

class PdvCalculator extends Component
{
    public $type;
    public $text=[];
    public $pdv = 25;
    public $amount = [];

    public function mount(){
        $this->startUp();
    }

    public function updatedAmountAmount1($key){
        if($key != ""){
            $this->calculate();
        }else{
            $this->amount['amount1'] = 0;
            $this->amount['amount2'] = 0;
        }
        
    }

    public function updatedPdv($key){
        if($key != ""){
            $this->calculate();
        }else{
            $this->amount['amount1'] = 0;
            $this->amount['amount2'] = 0;
            $this->pdv = 25;
        }
        
    }

    private function getReductionPercentage(){
        $startValue=100;
        $endValue = $startValue * (1 + $this->pdv/100);
        $reductionValue = $startValue / $endValue;
        return $reductionValue;
    }

    private function calculate(){
        if($this->type == 'add'){
            return $this->amount['amount2'] = $this->amount['amount1'] * (1 + $this->pdv/100);
        }
        if($this->type == 'remove'){
           return  $this->amount['amount2'] = $this->amount['amount1'] * $this->getReductionPercentage();
        }
        return;
    }
    
    private function startUp(){
        if($this->type == 'add'){
            $this->text = [
                'text1' => 'Iznos bez PDV-a',
                'text2' => 'Iznos sa PDV-om'
            ];
        }
        if($this->type == 'remove'){
            $this->text = [
                'text2' => 'Iznos bez PDV-a',
                'text1' => 'Iznos sa PDV-om'
            ];
        }
        return;
    }
    public function render()
    {
        return view('livewire.pdv-calculator');
    }
}

<?php

namespace App\Livewire\HidroProjekt;

use App\Services\HidroProjekt\HR\WorkerService;
use Livewire\Component;

class PrintLabelCheckbox extends Component
{   
    public $id;
    public $value;


    public function updatedValue(){
        WorkerService::updatePrintPayrollLabel($this->id,$this->value);
    }

    public function render()
    {
        return view('livewire.hidroprojekt.print-label-checkbox');
    }
}

<?php

namespace App\Livewire\HidroProjekt;

use App\Services\HidroProjekt\HR\WorkerService;
use Livewire\Component;

class PrintLabelCheckbox extends Component
{   
    public $row;
    public $value;


    public function updatedValue(){
        WorkerService::updatePrintPayrollLabel($this->row,$this->value);
    }

    public function render()
    {
        return view('livewire.hidroprojekt.print-label-checkbox');
    }
}

<?php

namespace App\Livewire\HidroProjekt\Hr\Payroll;

use App\Services\ModalOpenClose;
use Livewire\Component;

class WorkerDeductionModal extends Component 
{
    use ModalOpenClose;

    public function render()
    {
        return view('livewire.hidroprojekt.hr.payroll.worker-deduction-modal');
    }
}

<?php

namespace App\Livewire\HidroProjekt;

use Livewire\Component;
use App\Services\HidroProjekt\HR\WorkerService;

class IsWorkerCheckbox extends Component
{
    public $workerId;
    public $value;

    public function updatedValue(){
        WorkerService::updateIsWorker($this->workerId,$this->value);
    }

    public function render()
    {
        return view('livewire.hidroprojekt.is-worker-checkbox');
    }
}

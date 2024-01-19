<?php

namespace App\Livewire\HidroProjekt\Bde;

use App\Services\HidroProjekt\BDE\WorkerAttendanceService;
use Livewire\Component;

class BdeWorkerAttendance extends Component
{   
    public $record;
    public $workerCount;

    public function mount(){
        $this->workerCount = WorkerAttendanceService::getWorkerCount($this->record->id);
    }

    
    public function render()
    {
        return view('livewire.hidroprojekt.bde.bde-worker-attendance');
    }
}

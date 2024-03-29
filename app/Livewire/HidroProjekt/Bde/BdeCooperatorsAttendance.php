<?php

namespace App\Livewire\HidroProjekt\Bde;

use App\Services\HidroProjekt\BDE\CooperatorsAttendanceService;
use Livewire\Component;
 

class BdeCooperatorsAttendance extends Component
{
    public $record;
    public $workerCount;

    public function mount(){
        $this->workerCount = CooperatorsAttendanceService::getWorkerCount($this->record->id);
    }


    public function render()
    {
        return view('livewire.hidroprojekt.bde.bde-cooperators-attendance');
    }
}

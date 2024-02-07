<?php

namespace App\Livewire\HidroProjekt\Bde;

use App\Models\User;
use Livewire\Component;
use App\Services\HidroProjekt\BDE\WorkerAttendanceService;

class BdeWorkerAttendance extends Component
{   
    public $record;
    public $groupLeader;
    public $workerCount;

    public function mount(){
        $this->workerCount = WorkerAttendanceService::getWorkerCount($this->record->id);
        $this-> groupLeader = $this->getGroupLeaderName();
    }

    
    public function render()
    {
        return view('livewire.hidroprojekt.bde.bde-worker-attendance');
    }

    private function getGroupLeaderName(){
        $groupLeader = User::where('id', $this->record->user_id)->with('getWorker')->first();
        return $groupLeader;
    }
}

<?php

namespace App\Livewire\HidroProjekt\Bde;

use Livewire\Component;

class BdeWorkerInAttendanceRow extends Component
{
    public $worker;
    public $workHours;

    public function mount(){
        $this->workHours[$this->worker->worker_id] = $this->worker->work_hours;
    }

    public function updated(){
        dd($this->worker->worker_id, $this->worker->getWorkerInfo->firstName);
    }

    public function render()
    {
        return view('livewire.hidroprojekt.bde.bde-worker-in-attendance-row');
    }
}

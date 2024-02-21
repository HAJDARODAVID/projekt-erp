<?php

namespace App\Livewire\HidroProjekt\Hr;

use Livewire\Component;

class DeleteWorkerAttendanceEntryBtn extends Component
{
    public $row;

    public function deleteEntry(){
        $worker = $this->row->worker_id; 
        $this->row->delete();
        return redirect()->route('hp_workerWorkHours',$worker);
    }
    public function render()
    {
        return view('livewire.hidroprojekt.hr.delete-worker-attendance-entry-btn');
    }
}

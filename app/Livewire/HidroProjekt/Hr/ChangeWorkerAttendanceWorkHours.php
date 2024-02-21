<?php

namespace App\Livewire\HidroProjekt\Hr;

use Livewire\Component;

class ChangeWorkerAttendanceWorkHours extends Component
{
    public $row;
    public $workHours;

    public function mount(){
        $this->workHours = $this->row->work_hours;
    }

    public function updatedWorkHours($key, $value){
        $worker = $this->row->worker_id;
        if(!is_null($this->row->absence_reason)){
            $this->row->update([
                'absence_reason' => NULL,
                'work_hours' => $key,
            ]);
            return redirect()->route('hp_workerWorkHours',$worker);
        }else{
            $this->row->update([
                'work_hours' => $key,
            ]);
            return redirect()->route('hp_workerWorkHours',$worker);
        }
    }

    public function render()
    {
        return view('livewire.hidroprojekt.hr.change-worker-attendance-work-hours');
    }
}

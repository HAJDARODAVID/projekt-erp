<?php

namespace App\Livewire\HidroProjekt\Hr;

use Livewire\Component;

class WorkerChangeTypeInput extends Component
{
    public $row;
    public $workType;

    public function mount(){
        $this->workType = $this->row->type;
    }

    public function updatedWorkType($key, $value){
        $worker = $this->row->worker_id;
        if($key == '1' || $key == '2'){
            if(!is_null($this->row->work_hours)){
                $this->row->update([
                    'type' => $key,
                ]);
                return redirect()->route('hp_workerWorkHours',$worker);
            }
        }
        return redirect()->route('hp_workerWorkHours',$worker);
    }

    public function render()
    {
        return view('livewire.hidroprojekt.hr.worker-change-type-input');
    }
}

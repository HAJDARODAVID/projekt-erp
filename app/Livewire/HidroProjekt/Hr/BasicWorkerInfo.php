<?php

namespace App\Livewire\HidroProjekt\Hr;

use App\Models\WorkerModel;
use Exception;
use Livewire\Component;

class BasicWorkerInfo extends Component
{
    public $worker;
    public $saveState=[];
    public $workerModel;

    public function mount(){
        $this->worker = $this->workerModel->toArray();
    }

    public function updatedWorker($key, $value){
        try {
            $this->workerModel->update([
                $value => $key,
            ]);
            $this->saveState[$value] = TRUE;
        } catch (Exception $e) {
            dd($e);
        }
    }

    public function render()
    {
        return view('livewire.hidroprojekt.hr.basic-worker-info');
    }
}

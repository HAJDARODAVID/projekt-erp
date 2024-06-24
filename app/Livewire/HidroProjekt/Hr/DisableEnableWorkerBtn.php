<?php

namespace App\Livewire\HidroProjekt\Hr;

use App\Models\WorkerModel;
use Exception;
use Livewire\Component;

class DisableEnableWorkerBtn extends Component
{
    public $worker;

    public function deactivateUser(){
        try {
            $this->worker->update([
                'status' => WorkerModel::WORKER_STATUS_EX_EMPLOYEE,
            ]);
            redirect()->route('hp_showWorker', $this->worker->id);
        } catch (Exception $e) {
            dd($e);
        }
    }

    public function enableUser(){
        try {
            $this->worker->update([
                'status' => WorkerModel::WORKER_STATUS_EMPLOYED,
            ]);
            redirect()->route('hp_showWorker', $this->worker->id);
        } catch (Exception $e) {
            dd($e);
        }
    }

    public function render()
    {
        return view('livewire.hidroprojekt.hr.disable-enable-worker-btn');
    }
}

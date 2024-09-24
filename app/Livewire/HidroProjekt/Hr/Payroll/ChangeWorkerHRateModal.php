<?php

namespace App\Livewire\HidroProjekt\Hr\Payroll;

use App\Models\PayrollBasicInfoModel;
use App\Models\WorkerModel;
use Livewire\Component;
use Livewire\Attributes\On;

class ChangeWorkerHRateModal extends Component
{
    public $showModal = FALSE;
    public $worker;
    public $newValue;

    #[On('open-change-worker-h-rate')]
    public function openModal($data):void{
        $this->worker = WorkerModel::where('id', $data['workerId'])->with('getWorkerBasicPayrollInfo')->first();
        $this->newValue = $data['newValue'];
        $this->showModal = TRUE;
        return;
    } 

    public function changeBtn($type=2):void{
        //type => 1 --> change in worker info
        //type => 2 --> change only in this payroll accounting 
        if($type==1){
            $wbpi = $this->worker->getWorkerBasicPayrollInfo;
            if(is_null($wbpi)){
                PayrollBasicInfoModel::create([
                    'worker_id' => $this->worker->id,
                    'h_rate' => $this->newValue,     
                ]);
            }
            $wbpi->update([
                'h_rate' => $this->newValue,
            ]);
        }
        $this->showModal = FALSE;
        $this->dispatch('h-rate-confirmation', confirmation: TRUE, worker: $this->worker->id);
    }

    public function render()
    {
        return view('livewire.hidroprojekt.hr.payroll.change-worker-h-rate-modal');
    }
}

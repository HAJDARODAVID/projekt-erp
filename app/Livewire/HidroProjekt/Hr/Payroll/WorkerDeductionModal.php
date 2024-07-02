<?php

namespace App\Livewire\HidroProjekt\Hr\Payroll;

use App\Models\PayrollDeductionModel;
use App\Models\WorkerModel;
use App\Services\ModalOpenClose;
use App\Services\Months;
use Livewire\Component;
use Livewire\Attributes\On;

use function PHPUnit\Framework\isEmpty;

class WorkerDeductionModal extends Component 
{
    public $payroll;
    public $deductions;
    public $workers;
    public $locked = FALSE;
    public $month = Months::MONTHS_HR;

    //This will be used for item count
    public $i = 0;

    #[On('refresh-worker-deduction-modal')]
    public function refreshMe($data){
        $this->deductions = [];
        $this->i = 0;
        $this->payroll = $data['payroll'];
        $this->locked = isset($this->payroll['locked']) ? $this->payroll['locked'] : FALSE;
        $this->setDeductionArray($data['deductions']);
        $this->workers = WorkerModel::where('status', WorkerModel::WORKER_STATUS_EMPLOYED)->get();
        return;
    }

    public function saveBtn(){
        foreach ($this->deductions as $key => $item) {
            $newItem = NULL;
            if(isset($item['worker_id']) && isset($item['amount'])){
                if(!isset($item['id'])){
                    $newItem = PayrollDeductionModel::create([
                        'payroll_id' => $this->payroll['id'],
                        'worker_id'  => $item['worker_id'],
                        'amount'     => $item['amount'],
                        'reason'     => isset($item['reason']) ? $item['reason'] : NULL,
                    ]);
                }
                if(isset($item['id'])){
                    $oldItem = PayrollDeductionModel::where('id', $item['id'])->first()->update([
                        'worker_id' => $item['worker_id'],
                        'amount'    => $item['amount'],
                        'reason'    => isset($item['reason']) ? $item['reason'] : NULL,
                    ]);
                }
            }
        }
        $this->show = FALSE;
        return $this->dispatch('get-payroll-accounting-data');
    }

    public function deleteBtn($key){
        if(isset($this->deductions[$key]['id'])){
            PayrollDeductionModel::where('id', $this->deductions[$key]['id'])->first()->delete();
        }
        unset($this->deductions[$key]);
        return;
    }

    public function addItems(){
        $this->deductions[$this->i] = [];
        return $this->i++;
    }

    protected function setDeductionArray($data){
        if(!empty($data)){
            $this->i = count($data) + 1;
            return $this->deductions = $data;
        }else{
            $this->deductions[$this->i] = [];
            return $this->i++;
        };
    }

    use ModalOpenClose;

    public function render()
    {
        return view('livewire.hidroprojekt.hr.payroll.worker-deduction-modal');
    }
}

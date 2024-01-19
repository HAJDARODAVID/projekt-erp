<?php

namespace App\Livewire\HidroProjekt\Bde;

use App\Services\HidroProjekt\BDE\WorkerAttendanceService;
use Livewire\Component;
use Livewire\Attributes\On; 

class BdeWorkersInAttendanceTable extends Component
{
    public $record;
    public $allWorkers;
    public $workHours = [];

    #[On('refreshWorkersInAttendanceTable')] 
    public function mount(){
        $this->allWorkers = WorkerAttendanceService::getAllWorkersForEntry($this->record->id,true);
        $this->setWorkerHourArray();
    }

    public function removeWorker($id){
        WorkerAttendanceService::removeWorkerFromAttendance($id, $this->record->id);
        $this->dispatch('refreshWorkersInAttendanceTable')->self();
    }

    public function addAbsenceReason($reason, $id){
        WorkerAttendanceService::addAbsenceReasonToWorker($reason,$id, $this->record->id);
        $this->dispatch('refreshWorkersInAttendanceTable')->self();
    }

    public function render()
    {
        return view('livewire.hidroprojekt.bde.bde-workers-in-attendance-table');
    }

    public function updatedWorkHours($value, $key){
        WorkerAttendanceService::setWorkerAttendance($key,$this->record->id,$value);
    }

    private function setWorkerHourArray(){
        foreach ($this->allWorkers as $worker) {
            $this->workHours[$worker->worker_id] = $worker->work_hours;
        }
        return;
    }
}

<?php

namespace App\Livewire\HidroProjekt\Bde;

use Livewire\Component;
use App\Services\HidroProjekt\BDE\CooperatorsAttendanceService;
use Livewire\Attributes\On;

class BdeCoOpAttendanceTable extends Component
{
    public $record;
    public $attendance;
    public $hours = [];
    
   

    protected $listeners = ['refreshCoOpWorkersInAttendanceTable' => 'mount'];

    #[On('refreshCoOpWorkersInAttendanceTable')]
    public function mount(){
        $this->attendance = CooperatorsAttendanceService::getCoOpAttendanceForEntry($this->record->id);
        $this->setInputBoxModelArray();
    }

    public function removeGroupFromAttendance($group){
        CooperatorsAttendanceService::removeGroupFromAttendance($this->attendance[$group]);
        $this->dispatch('refreshCoOpWorkersInAttendanceTable')->self();
    }

    private function setInputBoxModelArray(){
        $this->hours=[];
        foreach ($this->attendance as $group) {
            foreach ($group as $wrk) {
                $this->hours[$wrk['id']] = CooperatorsAttendanceService::getWorkerHoursForEntry($wrk['id'],$this->record->id);
            }
        }
        return;
    }

    public function removeCoOpWorkerFromAttendance($attId){
        CooperatorsAttendanceService::removeWorkerFromAttendance($attId);
        $this->dispatch('refreshCoOpWorkersInAttendanceTable')->self();
    }

    public function updatedHours($key, $value){
        CooperatorsAttendanceService::updateWorkerHours($value, $key);
    }
    
    public function render()
    {
        return view('livewire.hidroprojekt.bde.bde-co-op-attendance-table');
    }
}

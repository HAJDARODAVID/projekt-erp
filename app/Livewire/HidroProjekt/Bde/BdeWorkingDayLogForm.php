<?php

namespace App\Livewire\HidroProjekt\Bde;

use App\Services\HidroProjekt\BDE\WorkingDayRecordService;
use Livewire\Component;
use Livewire\Attributes\On; 

class BdeWorkingDayLogForm extends Component
{
    public $record;
    public $log;
    public $allLogs;

    #[On('refreshLogsComponent')] 
    public function mount(){
        $this->log = "";
        $this->allLogs = WorkingDayRecordService::getAllLogsForEntry($this->record->id);
    }

    public function saveLog(){
        if($this->log == ""){
            return;
        };
        WorkingDayRecordService::addNewLog($this->log, $this->record);
        $this->log = "";
        $this->dispatch('refreshLogsComponent')->self();
    }

    public function deleteLog($id){
        WorkingDayRecordService::deleteLog($id);
        $this->dispatch('refreshLogsComponent')->self();
    }

    public function render()
    {
        return view('livewire.hidroprojekt.bde.bde-working-day-log-form');
    }
}

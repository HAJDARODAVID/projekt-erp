<?php

namespace App\Livewire\HidroProjekt\Bde;

use App\Services\HidroProjekt\BDE\WorkingDayRecordService;
use Livewire\Component;

class BdeWorkingDayLogForm extends Component
{
    public $record;
    public $log;

    public function saveLog(){
        WorkingDayRecordService::addNewLog($this->log, $this->record);
    }

    public function render()
    {
        return view('livewire.hidroprojekt.bde.bde-working-day-log-form');
    }
}

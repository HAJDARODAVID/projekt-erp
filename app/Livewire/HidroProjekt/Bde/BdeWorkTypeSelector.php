<?php

namespace App\Livewire\HidroProjekt\Bde;

use App\Models\WorkingDayRecordModel;
use Livewire\Component;

class BdeWorkTypeSelector extends Component
{
    public $record;
    public $home = false;
    public $field = false;

    public function mount(){
        $this->setCheckBoxes();
    }

    public function render()
    {
        return view('livewire.hidroprojekt.bde.bde-work-type-selector');
    }

    public function updatedHome(){
        $this->field = false;
        $this->record->update([
            'work_type' => WorkingDayRecordModel::WORK_TYPE_HOME,
        ]);
    }

    public function updatedField(){
        $this->home = false;
        $this->record->update([
            'work_type' => WorkingDayRecordModel::WORK_TYPE_FIELD_WORK,
        ]);
    }

    private function setCheckBoxes():void{
        if($this->record->work_type == WorkingDayRecordModel::WORK_TYPE_HOME){
            $this->home = true;
            return;
        }
        if($this->record->work_type == WorkingDayRecordModel::WORK_TYPE_FIELD_WORK){
            $this->field = true;
            return;
        }
    }
}

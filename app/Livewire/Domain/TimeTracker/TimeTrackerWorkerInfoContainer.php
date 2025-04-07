<?php

namespace App\Livewire\Domain\TimeTracker;

use Livewire\Component;
use App\Models\WorkerModel;
use Livewire\Attributes\On;
use Livewire\Attributes\Url;
use App\Traits\BasicTabSelector;
use Illuminate\Database\Eloquent\Collection;
use stdClass;

class TimeTrackerWorkerInfoContainer extends Component
{
    use BasicTabSelector;
    public $worker = NULL;

    public function mount(){
        $this->setTabs(['Kalendar', 'Tjedan', 'Dan']);
        $this->worker = new stdClass();
        $this->worker->fullName = 'N/A';
    }

    #[On('updated-selected-worker')]
    public function updatedSelectedWorker($wID){
        if(is_null($wID)){
            $this->worker = new stdClass();
            $this->worker->fullName = 'N/A';
            return;
        }
        $this->worker = WorkerModel::where('id', $wID)->first(); 
    }

    #[On('set-info-for-worker')]
    public function setInfoForSpecificWorker($param){
        $this->selectTab(2);
    }

    public function render()
    {
        return view('livewire.domain.time-tracker.time-tracker-worker-info-container');
    }
}

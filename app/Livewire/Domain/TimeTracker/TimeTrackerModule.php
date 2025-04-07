<?php

namespace App\Livewire\Domain\TimeTracker;

use Livewire\Component;
use App\Traits\BasicTabSelector;
use Livewire\Attributes\On;

class TimeTrackerModule extends Component
{
    use BasicTabSelector;

    public function mount(){
        $this->setTabs(['Mjesečni pregled', 'Radnici']);
    }

    #[On('open-worker-info')]
    public function openWorkerInfo($param){
        $this->selectTab(1);
        $this->dispatch('select-worker', $param['workerID'])->to(TimeTrackerPerWorker::class);
        $this->dispatch('set-info-for-worker',$param)->to(TimeTrackerWorkerInfoContainer::class);
    }
    
    public function render()
    {
        return view('livewire.domain.time-tracker.time-tracker-module');
    }
}

<?php

namespace App\Livewire\Domain\TimeTracker;

use Livewire\Component;
use App\Traits\BasicTabSelector;

class TimeTrackerModule extends Component
{
    public function mount(){
        $this->setTabs(['Mjesečni pregled', 'Radnici']);
    }

    use BasicTabSelector;
    
    public function render()
    {
        return view('livewire.domain.time-tracker.time-tracker-module');
    }
}

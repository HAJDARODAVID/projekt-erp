<?php

namespace App\Livewire\HidroProjekt\Bde;

use Livewire\Component;
use App\Services\HidroProjekt\BDE\CooperatorsAttendanceService;
use Livewire\Attributes\On;

class BdeCoOpAttendanceTable extends Component
{
    public $record;
    public $attendance;
   

    protected $listeners = ['refreshCoOpWorkersInAttendanceTable' => 'mount'];

    #[On('refreshCoOpWorkersInAttendanceTable')]
    public function mount(){
        $this->attendance = CooperatorsAttendanceService::getCoOpAttendanceForEntry($this->record->id);
    }
    
    public function render()
    {
        return view('livewire.hidroprojekt.bde.bde-co-op-attendance-table');
    }
}

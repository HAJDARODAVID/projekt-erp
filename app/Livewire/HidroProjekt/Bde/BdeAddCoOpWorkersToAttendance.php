<?php

namespace App\Livewire\HidroProjekt\Bde;

use Livewire\Component;
use App\Livewire\HidroProjekt\Bde\BdeCooperatorsAttendance;
use App\Services\HidroProjekt\BDE\CooperatorsAttendanceService;

class BdeAddCoOpWorkersToAttendance extends Component
{
    public $entry;
    public $coOpTeam;

    public function mount(){

    }

    public function render()
    {
        return view('livewire.hidroprojekt.bde.bde-add-co-op-workers-to-attendance');
    }

    public function addCoOpWorkersToAttendance(){
        CooperatorsAttendanceService::setAttendanceForCoOpWorkers($this->entry, $this->coOpTeam);
        $this->dispatch('refreshCoOpWorkersInAttendanceTable');
    }
}

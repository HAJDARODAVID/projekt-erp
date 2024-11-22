<?php

namespace App\Livewire\Domain\Bde\MainWorkReportModules\Attendance;

use Livewire\Component;
use Livewire\Attributes\On; 

class AddToAttendanceBtn extends Component
{
    public $row;
    public $btnShow = FALSE;

    public function mount(){
        $this->dispatch('ask-if-worker-is-in-attendance', $this->row->id);
    }

    public function addToAttendance(){
        $this->dispatch('add-worker-to-attendance', $this->row)->to(Attendance::class);
        $this->btnShow = FALSE;
    }

    #[On('answer-if-worker-is-in-attendance{row.id}')]
    public function setBtnShow($answer){
        $this->btnShow = !($answer);
    }

    public function render()
    {
        return view('livewire.domain.bde.main-work-report-modules.attendance.add-to-attendance-btn');
    }

}

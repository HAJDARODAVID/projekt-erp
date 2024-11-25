<?php

namespace App\Livewire\Domain\Bde\MainWorkReportModules\Attendance;

use Livewire\Component;
use Livewire\Attributes\On; 
use Illuminate\Support\Facades\Session;
class AddToAttendanceBtn extends Component
{
    public $row;
    public $btnShow = FALSE;

    public function mount(){
        $this->dispatch('ask-if-worker-is-in-attendance', $this->row->id);
    }

    public function addToAttendance(){
        $array[$this->row->id] = ['name' => $this->row['firstName'] . ' ' . $this->row['lastName']];
        $storage = Session::get('att_storage');
        if($storage != NULL) {
            $array = $storage + $array;
        }
        Session::put('att_storage', $array);
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

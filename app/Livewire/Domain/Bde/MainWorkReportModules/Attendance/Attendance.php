<?php

namespace App\Livewire\Domain\Bde\MainWorkReportModules\Attendance;

use App\Models\User;
use Livewire\Component;
use Livewire\Attributes\On;
use Illuminate\Support\Facades\Auth;

class Attendance extends Component
{
    public $user;
    public $attendance = [];

    public function mount(){
        $this->setUser();
        $this->attendance[6] = [
            'name' => 'Aleksandar Đerić',
        ];
    }

    #[On('add-worker-to-attendance')]
    public function addWorkerToAttendance($row){
        $this->attendance[$row['id']] = [
            'name' => $row['firstName'] . ' ' . $row['lastName']
        ];
    }

    #[On('ask-if-worker-is-in-attendance')]
    public function isWorkerInAttendance($workerID){        
        return $this->dispatch('answer-if-worker-is-in-attendance'.$workerID, array_key_exists($workerID, $this->attendance));
    }

    private function setUser(){
        $this->user = User::where('id', Auth::user()->id)->with('getWorker')->first();
        return $this;
    }
    public function render()
    {
        return view('livewire.domain.bde.main-work-report-modules.attendance.attendance');
    }
}

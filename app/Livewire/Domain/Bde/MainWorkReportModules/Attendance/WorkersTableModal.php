<?php

namespace App\Livewire\Domain\Bde\MainWorkReportModules\Attendance;

use Livewire\Component;

class WorkersTableModal extends Component
{
    public $show=false;

    public function toggleModal(){
        if($this->show){
            $this->dispatch('add-worker-to-attendance')->to(Attendance::class);
        }
        return $this->show = !$this->show;
    }

    public function render()
    {
        return view('livewire.domain.bde.main-work-report-modules.attendance.workers-table-modal');
    }
}

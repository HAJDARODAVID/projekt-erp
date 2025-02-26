<?php

namespace App\Livewire\Domain\Attendance;

use App\Services\Traits\BasicModal;
use App\Services\Traits\BasicTabSelector;
use Livewire\Component;

class AddWorkersToReportBtn extends Component
{
    use BasicModal;
    use BasicTabSelector;
    
    public function render()
    {
        return view('livewire.domain.attendance.add-workers-to-report-btn');
    }
}

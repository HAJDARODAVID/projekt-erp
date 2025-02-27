<?php

namespace App\Livewire\Domain\Attendance;

use App\Services\Traits\BasicModal;
use App\Services\Traits\BasicTabSelector;
use Livewire\Component;

/**
 * With this component you will get a btn and a modal for adding workers to the attendance.
 * This is meant to be used for adding workers to specific daily report. 
 */
class AddWorkersToReportBtn extends Component
{
    /**
     * Import some trait to be used in this component
     */
    use BasicModal;
    use BasicTabSelector;

    public $wdr;
    
    public function render()
    {
        return view('livewire.domain.attendance.add-workers-to-report-btn');
    }
}

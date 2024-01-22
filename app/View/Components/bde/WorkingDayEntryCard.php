<?php

namespace App\View\Components\bde;

use Closure;
use Illuminate\View\Component;
use Illuminate\Contracts\View\View;
use App\Models\WorkingDayRecordModel;
use App\Services\HidroProjekt\BDE\WorkerAttendanceService;
use App\Services\HidroProjekt\BDE\WorkingDayRecordService;

class WorkingDayEntryCard extends Component
{
    public $entry;
    public $workerCount;
    public $isAttendanceComplete;
    public $isEntryComplete;
    /**
     * Create a new component instance.
     */
    public function __construct($entry)
    {
        $this->entry = $entry;

        dd( $this->entry);
        $this->workerCount = WorkerAttendanceService::getWorkerCount($this->entry->id);
        $this->isAttendanceComplete = WorkerAttendanceService::isAttendanceComplete($this->entry->id);
        $this->isEntryComplete = WorkingDayRecordService::isEntryComplete([$this->isAttendanceComplete]);
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.bde.working-day-entry-card');
    }
}

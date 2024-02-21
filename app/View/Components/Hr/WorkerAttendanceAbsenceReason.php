<?php

namespace App\View\Components\Hr;

use App\Models\AttendanceModel;
use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class WorkerAttendanceAbsenceReason extends Component
{
    public $absenceShtTxt;
    /**
     * Create a new component instance.
     */
    public function __construct()
    {
        $this->absenceShtTxt = AttendanceModel::ABSENCE_REASON;
        dd($this->absenceShtTxt);
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.hr.worker-attendance-absence-reason');
    }
}

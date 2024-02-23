<?php

namespace App\View\Components\Hr;

use App\Models\AttendanceModel;
use App\Models\ConstructionSiteModel;
use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class AddNewAttendanceEntryModal extends Component
{
    public $constSites;
    public $worker;
    public $absence;
    /**
     * Create a new component instance.
     */
    public function __construct($worker)
    {
        $this->constSites = ConstructionSiteModel::where('status', ConstructionSiteModel::CONSTRUCTION_STATUS_ACTIVE)->get();
        $this->worker = $worker;
        $this->absence = [
            'sick' => AttendanceModel::ABSENCE_REASON_SICK_LEAVE,
            'paid' => AttendanceModel::ABSENCE_REASON_PAID_LEAVE,
        ];
        dd($this->absence);
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.hr.add-new-attendance-entry-modal',[
            'constSites' => $this->constSites,
        ]);
    }
}

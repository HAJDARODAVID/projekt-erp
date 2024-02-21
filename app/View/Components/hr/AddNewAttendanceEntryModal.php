<?php

namespace App\View\Components\hr;

use App\Models\ConstructionSiteModel;
use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class AddNewAttendanceEntryModal extends Component
{
    public $constSites;
    /**
     * Create a new component instance.
     */
    public function __construct()
    {
        $this->constSites = ConstructionSiteModel::where('status', ConstructionSiteModel::CONSTRUCTION_STATUS_ACTIVE)->get();
        dd($this->constSites);
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

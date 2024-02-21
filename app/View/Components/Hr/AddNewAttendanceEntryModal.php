<?php

namespace App\View\Components\Hr;

use App\Models\ConstructionSiteModel;
use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class AddNewAttendanceEntryModal extends Component
{
    public $consts;
    /**
     * Create a new component instance.
     */
    public function __construct()
    {
        $this->consts = ConstructionSiteModel::where('status', ConstructionSiteModel::CONSTRUCTION_STATUS_ACTIVE)->get();
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.hr.add-new-attendance-entry-modal',[
            'consts' => $this->consts,
        ]);
    }
}

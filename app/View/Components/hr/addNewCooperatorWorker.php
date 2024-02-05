<?php

namespace App\View\Components\hr;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class addNewCooperatorWorker extends Component
{
    public $cooperatorId;
    /**
     * Create a new component instance.
     */
    public function __construct($cooperatorId)
    {
        $this->cooperatorId = $cooperatorId;
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.hr.add-new-cooperator-worker');
    }
}

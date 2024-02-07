<?php

namespace App\View\Components\Bde;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class AddWorkerToAttendance extends Component
{
    /**
     * Create a new component instance.
     */
    public function __construct()
    {
        //
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.bde.add-worker-to-attendance');
    }
}

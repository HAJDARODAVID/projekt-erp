<?php

namespace App\View\Components\Ui\Employees;

use App\Models\Employees\Worker;
use App\Models\Employees\WorkerStatus;
use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class StatusIndicator extends Component
{
    public $indicator = NULL;
    /**
     * Create a new component instance.
     */
    public function __construct($empID)
    {
        $empObj = Worker::find($empID);
        if ($empObj != NULL) $this->indicator = WorkerStatus::setByStatus($empObj->status)->getWorkerStatusIndicator();
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.ui.employees.status-indicator');
    }
}

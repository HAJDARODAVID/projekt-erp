<?php

namespace App\View\Components\bde;

use Closure;
use Illuminate\View\Component;
use Illuminate\Contracts\View\View;
use App\Models\WorkingDayRecordModel;

class WorkingDayEntryCard extends Component
{
    public $entry;
    /**
     * Create a new component instance.
     */
    public function __construct($entry)
    {
        $this->entry = $entry;
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.bde.working-day-entry-card');
    }
}

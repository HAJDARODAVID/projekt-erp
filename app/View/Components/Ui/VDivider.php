<?php

namespace App\View\Components\Ui;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class VDivider extends Component
{
    public $px;
    public $mx;
    /**
     * Create a new component instance.
     */
    public function __construct(
        $px = NULL,
        $mx = NULL,
    )
    {
        $this->px = $px;
        $this->mx = $mx;
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.ui.v-divider');
    }
}

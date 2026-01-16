<?php

namespace App\View\Components\Ui;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class PleaseWait extends Component
{
    public string|NULL $loading;
    /**
     * Create a new component instance.
     */
    public function __construct(string|NULL $loading = NULL)
    {
        $this->loading = $loading;
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.ui.please-wait');
    }
}

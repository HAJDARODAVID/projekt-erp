<?php

namespace App\View\Components\Ui\Layout;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class Header extends Component
{
    public $pageTitle;
    /**
     * Create a new component instance.
     */
    public function __construct(
        $pageTitle = NULL,
    )
    {
        $this->pageTitle = $pageTitle;
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.ui.layout.header');
    }
}

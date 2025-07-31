<?php

namespace App\View\Components\Ui\Module;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class Header extends Component
{
    public $title;
    public $actionsBtn;
    public $headerInput;
    /**
     * Create a new component instance.
     */
    public function __construct(
        $title = NULL,
        $actionsBtn = NULL,
        $headerInput = NULL,
    ) {
        $this->title = $title;
        $this->actionsBtn = $actionsBtn;
        $this->headerInput = $headerInput;
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.ui.module.header');
    }
}

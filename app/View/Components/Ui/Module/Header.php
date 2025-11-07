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
    public $tabLinks;
    public $specialIndexIcon;
    /**
     * Create a new component instance.
     */
    public function __construct(
        $title = NULL,
        $actionsBtn = NULL,
        $headerInput = NULL,
        $tabLinks = NULL,
        $specialIndexIcon = NULL,
    ) {
        $this->title = $title;
        $this->actionsBtn = $actionsBtn;
        $this->headerInput = $headerInput;
        $this->tabLinks = $tabLinks;
        $this->specialIndexIcon = $specialIndexIcon;
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.ui.module.header');
    }
}

<?php

namespace App\View\Components\Ui\Module;

use Closure;
use Illuminate\View\Component;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\Route;

class TabLinkItem extends Component
{
    public $routeName;
    public $title;
    public $active;
    /**
     * Create a new component instance.
     */
    public function __construct(
        $routeName = NULL,
        $title = NULL,
        $active = FALSE,
    ) {
        $this->routeName = $routeName;
        $this->title = $title;
        $this->active = $this->checkIfThisRouteIsActive();
    }

    private function checkIfThisRouteIsActive()
    {
        return Route::currentRouteName() == $this->routeName;
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.ui.module.tab-link-item');
    }
}

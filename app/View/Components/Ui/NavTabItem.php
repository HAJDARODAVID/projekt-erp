<?php

namespace App\View\Components\Ui;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

/**
 * This component will create a single tab item.
 */
class NavTabItem extends Component
{
    public $title;
    public $tabKey;
    public $method;
    public $active = FALSE;

    /**
     * Create a new component instance.
     */
    public function __construct(
        $title,
        $tabKey,
        $method,
        $selectedTab,
    )
    {
        $this->title = $title;
        $this->tabKey = $tabKey;
        $this->method = $method;
        $this->active = $selectedTab == $tabKey ? TRUE : FALSE;
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.ui.nav-tab-item');
    }
}

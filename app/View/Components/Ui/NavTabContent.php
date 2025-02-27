<?php

namespace App\View\Components\Ui;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

/**
 * In this component add your component for the tabs.
 * Important: pass the tab key and selected tab
 */
class NavTabContent extends Component
{
    public $tabKey;
    public $active = FALSE;
    
    /**
     * Create a new component instance.
     */
    public function __construct(
        $tabKey,
        $selectedTab,
    )
    {
        $this->tabKey = $tabKey;
        $this->active = $this->tabKey == $selectedTab ? TRUE : FALSE;
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.ui.nav-tab-content');
    }
}

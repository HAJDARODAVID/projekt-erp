<?php

namespace App\View\Components\Ui\Nav;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

/**
 * In this component add your component for the tabs.
 * Important: pass the tab key and selected tab
 */
class TabContent extends Component
{
    public $tabKey;
    public $active = FALSE;
    public $dFlex;
    public $tabID;

    /**
     * Create a new component instance.
     */
    public function __construct(
        $tabKey,
        $selectedTab,
        $dFlex = FALSE,
        $tabID = NULL,
    )
    {
        $this->tabKey = $tabKey;
        $this->dFlex = $dFlex;
        $this->tabID = $tabID;
        $this->active = $this->tabKey == $selectedTab ? TRUE : FALSE;
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.ui.nav.tab-content');
    }
}

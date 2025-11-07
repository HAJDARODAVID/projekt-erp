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
    public $divHeight = NULL;

    /**
     * Create a new component instance.
     */
    public function __construct(
        $tabKey,
        $divHeight = NULL,
        $selectedTab = NULL,
    ) {
        $this->tabKey = $tabKey;
        $this->divHeight = $this->setHeight($divHeight);
        $this->active = $this->tabKey == $selectedTab ? TRUE : FALSE;
    }

    private function setHeight($divHeight)
    {
        switch ($divHeight) {
            case 'full':
                return "h-100 d-flex flex-column";
                break;
        }
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.ui.nav-tab-content');
    }
}

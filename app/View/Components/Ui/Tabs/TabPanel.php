<?php

namespace App\View\Components\Ui\Tabs;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class TabPanel extends Component
{
    public $tabId;
    public $activeTab;
    /**
     * Create a new component instance.
     */
    public function __construct(
        $tabId,
        $activeTab,
    ) {
        $this->tabId = $tabId;
        $this->activeTab = $activeTab;
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.ui.tabs.tab-panel');
    }
}

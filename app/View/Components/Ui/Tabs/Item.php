<?php

namespace App\View\Components\Ui\Tabs;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class Item extends Component
{
    public $name;
    public $tabId;
    public $activeTab;
    public $wireMethod;

    /**
     * Create a new component instance.
     */
    public function __construct(
        $name,
        $tabId,
        $activeTab,
        $wireMethod,
    ) {
        $this->name = $name;
        $this->tabId = $tabId;
        $this->activeTab = $activeTab;
        $this->wireMethod = $wireMethod;
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.ui.tabs.item');
    }
}

<?php

namespace App\View\Components\Ui;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class Tabs extends Component
{
    private $defaultWireMethod = 'selectTab';
    public $tabs;
    public $activeTab;
    public $wireMethod;
    /**
     * Create a new component instance.
     */
    public function __construct(
        array $tabs,
        $activeTab,
        $wireMethod = NULL,
    ) {
        $this->tabs = $tabs;
        $this->activeTab = $activeTab;
        $this->wireMethod = $wireMethod !== NULL ? $wireMethod : $this->defaultWireMethod;
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.ui.tabs');
    }
}

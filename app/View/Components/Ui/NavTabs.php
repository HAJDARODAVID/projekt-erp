<?php

namespace App\View\Components\Ui;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

/**
 * This will create a new nav tabs component.
 * To add the items in the property $tabs add the names of the tab items.
 * Ex: :tabs="['Tab name 01', 'Tab name 02']"
 * And pass the selected tab key to the property $selectedTab so that it will show as active
 */
class NavTabs extends Component
{
    public array $tabs;
    public $wireClickSelectTabMethod;
    public $selectedTab;
    /**
     * Create a new component instance.
     */
    public function __construct(
        array $tabs,
        $selectedTab,
        $wireClickSelectTabMethod = 'selectTab',
    )
    {
        $this->tabs = $tabs;
        $this->wireClickSelectTabMethod = $wireClickSelectTabMethod;
        $this->selectedTab = $selectedTab;
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.ui.nav-tabs');
    }
}

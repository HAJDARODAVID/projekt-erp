<?php

namespace App\View\Components\Ui\Nav;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

/**
 * This will create a new nav tabs component.
 * To add the items in the property $tabs add the names of the tab items.
 * Ex: :tabs="['Tab name 01', 'Tab name 02']"
 * And pass the selected tab key to the property $selectedTab so that it will show as active
 */
class Tabs extends Component
{
    public array $tabs;
    public $wireClickSelectTabMethod;
    public $selectedTab;
    public $addTabs;
    public $wireClickAddTabMethod;
    public $removeTab;
    public $wireClickRemoveTabMethod;
    public $py;
    /**
     * Create a new component instance.
     */
    public function __construct(
        array $tabs,
        $selectedTab,
        $addTabs = FALSE,
        $wireClickAddTabMethod = 'addNewTab',
        $wireClickSelectTabMethod = 'selectTab',
        $removeTab = FALSE,
        $wireClickRemoveTabMethod = 'removeTab',
        $py = NULL,
        
    )
    {
        $this->tabs = $tabs;
        $this->addTabs = $addTabs;
        $this->wireClickAddTabMethod = $wireClickAddTabMethod;
        $this->wireClickSelectTabMethod = $wireClickSelectTabMethod;
        $this->removeTab = $removeTab;
        $this->wireClickRemoveTabMethod = $wireClickRemoveTabMethod;
        $this->selectedTab = $selectedTab;
        $this->py = $py;
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.ui.nav.tabs');
    }
}

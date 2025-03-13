<?php

namespace App\View\Components\Ui\Nav;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class TabItem extends Component
{
    public $title;
    public $tabKey;
    public $method;
    public $closeBtn;
    public $closeBtnMethod;
    public $active = FALSE;
    public $py;

    /**
     * Create a new component instance.
     */
    public function __construct(
        $title,
        $tabKey,
        $method,
        $selectedTab,
        $closeBtnMethod = NULL,
        $closeBtn = FALSE,
        $py = NULL,
    )
    {
        $this->title = $title;
        $this->tabKey = $tabKey;
        $this->method = $method;
        $this->closeBtn = $closeBtn;
        $this->closeBtnMethod = $closeBtnMethod;
        $this->py = $py;
        $this->active = $selectedTab == $tabKey ? TRUE : FALSE;
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.ui.nav.tab-item');
    }
}

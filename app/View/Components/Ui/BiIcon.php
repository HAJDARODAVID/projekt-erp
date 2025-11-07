<?php

namespace App\View\Components\Ui;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class BiIcon extends Component
{
    const ICON_ALIAS = [
        'save' => 'floppy',
        'add' => 'plus-circle',
    ];

    public $icon = NULL;
    /**
     * Create a new component instance.
     */
    public function __construct($icon = NULL)
    {
        $this->setIcon($icon);
    }

    private function setIcon($icon = NULL)
    {
        if (is_null($icon)) return;

        if (array_key_exists($icon, self::ICON_ALIAS)) return $this->icon = self::ICON_ALIAS[$icon];
        return $this->icon = $icon;
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.ui.bi-icon');
    }
}

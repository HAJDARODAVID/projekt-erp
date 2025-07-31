<?php

namespace App\View\Components\Ui;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class Select extends Component
{
    public $label;
    public $wModel;
    public $wModelEvent;
    public $options;
    public $initOption;
    /**
     * Create a new component instance.
     */
    public function __construct(
        array $options,
        $label = NULL,
        $wModel = NULL,
        $wModelEvent = 'change',
        $initOption = NULL,
    ) {
        $this->options = $options;
        $this->label = $label;
        $this->wModel = $wModel;
        $this->wModelEvent = $wModelEvent;
        $this->initOption = $initOption;
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.ui.select');
    }
}

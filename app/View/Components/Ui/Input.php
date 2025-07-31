<?php

namespace App\View\Components\Ui;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class Input extends Component
{
    public $type;
    public $label;
    public $placeholder;
    public $wModel;
    public $wModelEvent;
    public $prepend;
    public $append;

    /**
     * Create a new component instance.
     */
    public function __construct(
        $type = 'text',
        $label = NULL,
        $placeholder = NULL,
        $wModel = NULL,
        $wModelEvent = 'blur',
        $prepend = NULL,
        $append = NULL,
    ) {
        $this->type = $type;
        $this->label = $label;
        $this->placeholder = $placeholder;
        $this->wModel = $wModel;
        $this->wModelEvent = $wModelEvent;
        $this->prepend = $prepend;
        $this->append = $append;
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.ui.input');
    }
}

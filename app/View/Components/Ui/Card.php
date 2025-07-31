<?php

namespace App\View\Components\Ui;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class Card extends Component
{
    public $title;
    public $extend;
    public $extendClassAtt;
    /**
     * Create a new component instance.
     */
    public function __construct(
        $title = NULL,
        $extend = TRUE,
        $extendClassAtt = NULL,
    )
    {
        $this->title = $title;
        $this->extend = $extend;
        $this->extendClassAtt = $this->extend == TRUE ? 'flex-fill h-100 d-flex flex-column' : NULL;
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.ui.card');
    }
}

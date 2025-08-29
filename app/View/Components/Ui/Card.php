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
    public $headerActions;
    public $loading;
    public $noBodyPadding;
    public $border;
    public $noBgColor;
    /**
     * Create a new component instance.
     */
    public function __construct(
        $title = NULL,
        $extend = TRUE,
        $extendClassAtt = NULL,
        $headerActions = NULL,
        $loading = FALSE,
        $noBodyPadding = FALSE,
        $border = TRUE,
        $noBgColor = NULL,
    ) {
        $this->title = $title;
        $this->extend = $extend;
        $this->extendClassAtt = $this->extend == TRUE ? 'flex-fill h-100 d-flex flex-column' : NULL;
        $this->headerActions = $headerActions;
        $this->loading = $loading;
        $this->noBodyPadding = $noBodyPadding == TRUE ? 'p-0' : NULL;
        $this->border = $border == TRUE ? NULL : 'no-border-style';
        $this->noBgColor = $noBgColor == TRUE ? 'no-bg-color' : NULL;
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.ui.card');
    }
}

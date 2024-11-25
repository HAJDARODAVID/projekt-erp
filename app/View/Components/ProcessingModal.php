<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class ProcessingModal extends Component
{
    public $target;
    public $blur;
    const BLUR_ATT = 'background-color: rgba(0, 0, 0, 0.4); backdrop-filter: blur(5px)';
    /**
     * Create a new component instance.
     */
    public function __construct(
        $target=NULL,
        $blur = TRUE,)
    {
        $this->target = $target;
        $this->blur = $blur ? self::BLUR_ATT : NULL;
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.processing-modal');
    }
}

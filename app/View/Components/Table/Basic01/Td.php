<?php

namespace App\View\Components\Table\Basic01;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class Td extends Component
{
    public $value;
    /**
     * Create a new component instance.
     */
    public function __construct(
        $value = NULL,
    )
    {
        $this->value = $value;
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.table.basic01.td');
    }
}

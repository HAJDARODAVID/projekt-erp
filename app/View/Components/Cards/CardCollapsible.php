<?php

namespace App\View\Components\Cards;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class CardCollapsible extends Component
{
    public $title;
    public $headerBtn;
    /**
     * Create a new component instance.
     */
    public function __construct(
        $title = 'Card title',
        $headerBtn = NULL,
    )
    {
        $this->title = $title;
        $this->headerBtn = $headerBtn;
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.cards.card-collapsible');
    }
}

<?php

namespace App\View\Components\Ui\Card;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class BasicCard extends Component
{
    public $title;
    public $tabs;
    public $option;
    public $resetP;
    public $header;
    public $overflow;
    public $search;
    public $searchModel;

    /**
     * Create a new component instance.
     */
    public function __construct(
        $title = NULL,
        $tabs = NULL,
        $option = NULL,
        $resetP = FALSE,
        $header = FALSE,
        $overflow = FALSE,
        $search = FALSE,
        $searchModel = NULL,

    )
    {
        $this->title = $title;
        $this->tabs = $tabs;
        $this->option = $option;
        $this->resetP = $resetP;
        $this->header = $header;
        $this->overflow = $overflow;
        $this->search = $search;
        $this->searchModel = $searchModel;
        
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.ui.card.basic-card');
    }
}

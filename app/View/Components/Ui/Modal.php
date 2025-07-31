<?php

namespace App\View\Components\Ui;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class Modal extends Component
{
    private $defaultCloseMethod = 'closeModal';
    public $title;
    public $modalStatus;
    public $closeModelMethod;
    public $size;
    public $footerRight;
    public $footerLeft;
    public $id;
    public $wKey;

    /**
     * Create a new component instance.
     */
    public function __construct(
        $title = NULL,
        $modalStatus = FALSE,
        $closeModelMethod = NULL,
        $size = NULL,
        $footerRight = NULL,
        $footerLeft = NULL,
        $id = NULL,
        $wKey = NULL,
    ) {
        $this->title = $title;
        $this->modalStatus = $modalStatus;
        $this->closeModelMethod = $closeModelMethod !== NULL ? $closeModelMethod : $this->defaultCloseMethod;
        $this->size = $size;
        $this->footerRight = $footerRight;
        $this->footerLeft = $footerLeft;
        $this->id = $id;
        $this->wKey = $wKey;
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.ui.modal');
    }
}

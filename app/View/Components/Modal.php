<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class Modal extends Component
{
    public $show;
    public $alert;
    public $aType;
    public $size;
    public $header;
    public $mainTitle;
    public $secTitle;
    public $headerBtn;
    public $body;
    public $footer;
    public $footerItems;
    /**
     * Create a new component instance.
     */
    public function __construct(
        $show   = FALSE,
        $alert = FALSE,
        $aType = NULL,
        $size = NULL,
        $header = TRUE,
        $mainTitle = NULL,
        $secTitle = NULL,
        $headerBtn = NULL,
        $body   = TRUE,
        $footer = TRUE,
        $footerItems = NULL)
    {
        $this->show   = $show;
        $this->alert = $alert;
        $this->aType = $this->setAlertType($aType);
        $this->size = $this->setModalSize($size);
        $this->header = $header;
        $this->mainTitle = $mainTitle;
        $this->secTitle = $secTitle;
        $this->headerBtn = $headerBtn;
        $this->body   = $body;
        $this->footer = $footer;
        $this->footerItems = $footerItems;
    }

    protected function setModalSize($size){
        if($size == 'sm' || $size == 'lg'){
            return $size;
        }
        return NULL;
    }

    protected function setAlertType($aType){
        $possibleTypes=['primary', 'secondary', 'success', 'danger', 'warning', 'info', 'light', 'dark'];
        if(in_array($aType,$possibleTypes)){
            return $aType;
        }
        return NULL;
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.modal');
    }
}

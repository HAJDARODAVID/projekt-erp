<?php

namespace App\View\Components\Dashboard;

use Closure;
use Illuminate\Support\Str;
use Illuminate\View\Component;
use Illuminate\Contracts\View\View;

class CardComponent extends Component
{
    const DEF_COLOR = "rgb(252, 252, 252)";
    const DEF_LIVEWIRE_PATH = "hidroProjekt.dashboard.";
    const HEADER_COLOR = "rgb(236, 236, 236)";
    public $cardId;
    public $bgColor;
    public $headerColor;
    public $height;
    public $title;
    public $livewire;
    public $center;
    /**
     * Create a new component instance.
     */
    public function __construct(
        $bgColor=NULL,
        $headerColor=NULL, 
        $height=NULL, 
        $title = 'Lorem ipsum dolor',
        $livewire = NULL,
        $center =NULL,
    )
    {
        $this->cardId = Str::uuid()->toString();
        $this->bgColor = $this->setBgColor($bgColor);
        $this->headerColor = $this->setHeaderColor($headerColor);
        $this->height = $height;
        $this->title = $title;
        $this->livewire = $livewire;
        $this->center = $center;
    }

    /**
     * Set the background color for the cards
     */
    public function setBgColor($bgColor){
        if(is_null($bgColor) || $bgColor ==""){
            return self::DEF_COLOR;
        }
        return $bgColor;
    }

    /**
     * Set the background color for the cards header
     */
    public function setHeaderColor($headerColor){
        if(is_null($headerColor) || $headerColor ==""){
            return self::HEADER_COLOR;
        }
        return $headerColor;
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.dashboard.card-component',[
            'lw_path' => self::DEF_LIVEWIRE_PATH,
        ]);
    }
}

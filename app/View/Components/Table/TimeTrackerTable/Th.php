<?php

namespace App\View\Components\Table\TimeTrackerTable;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class Th extends Component
{
    const COLORS=[
        'gray' => 'rgb(192,195,199)',
    ];
    public $name;
    public $center;
    public $width;
    public $br;
    public $bl;
    public $bt;
    public $bb;
    public $borderStyle;
    public $bgStyle = NULL;
    public $sticky;
    /**
     * Create a new component instance.
     */
    public function __construct(
        $name = NULL,
        $center = TRUE,
        $width = NULL,   
        $br = [],
        $bl = [],
        $bt = [],
        $bb = [],
        $borderStyle = NULL,
        $date = NULL,
        $sticky = FALSE,
        )
    {
        $this->center = $center;
        $this->name = $name;
        $this->width = $width;
        $this->br = $br;
        $this->bl = $bl;
        $this->bt = $bt;
        $this->bb = $bb;
        $this->sticky = $sticky;
        $this->borderStyle = $this->setBorderStyle($borderStyle);
        $date != NULL ? $this->setBackgroundColor($date) : NULL;
    }

    private function setBorderStyle($borderStyle){
        if(!is_null($borderStyle)){
            $expressions=  explode('-',$borderStyle);
            foreach($expressions as $exp){
                list($orientation, $size, $style, $color) = explode('.',$exp);
                if(!property_exists(get_class($this), $orientation)){
                    return;
                }
                if(!array_key_exists($color, self::COLORS)){
                    $color = 'black';
                }else{
                    $color = self::COLORS[$color];
                }
                $this->$orientation = [$size,$style,$color];
            }            
        }    
    }

    private function setBackgroundColor($date){
        $dayNum = date("N", strtotime($date));
        if($dayNum>5){
            $this->bgStyle = '#d4d4d4';
        }
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.table.time-tracker-table.th');
    }
}

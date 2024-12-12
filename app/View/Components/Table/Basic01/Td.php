<?php

namespace App\View\Components\Table\Basic01;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class Td extends Component
{
    private $cellType = 'td';
    public $value;
    public $style;

    public $numberFormat = FALSE;
    public $currencySymbol = NULL;
    /**
     * Create a new component instance.
     */
    public function __construct(
        $value = NULL,
        $style =[],
    )
    {
        $this->value = $value;
        $this->style =  $style;
        $this->setStyles($this->style);  
    }

    private function setStyles($style){
        if($style){
            if($style->{$this->cellType}){
                foreach ($style->{$this->cellType} as $method => $property) {
                    if(method_exists(get_class($this), 'set'.ucfirst($method))){
                        $methodName = 'set'.ucfirst($method);
                        return $this->$methodName($property);
                    }
                }
            }
        }   
    }

    private function setIsCurrency(?array $param){
        if(isset($param[0])){
            if($param[0] == TRUE){
                $this->numberFormat = $param[0];
                $this->currencySymbol = $param[1];
            }
        }
    }

    private function setIsNumber(?array $param){
        if(isset($param[0])){
            if($param[0] == TRUE){
                $this->numberFormat = $param[0];
            }
        }
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.table.basic01.td');
    }
}

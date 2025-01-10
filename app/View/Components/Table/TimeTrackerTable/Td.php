<?php

namespace App\View\Components\Table\TimeTrackerTable;

use App\Models\AttendanceModel;
use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class Td extends Component
{
    const COLORS=[
        'gray' => 'rgb(192,195,199)',
    ];
    public $value;
    public $center;
    public $br;
    public $bl;
    public $bt;
    public $bb;
    public $borderStyle;
    public $bgStyle = NULL;
    public $textColor = NULL;
    public $fontWeight = NULL;
    public $sticky;
    public $type;
    public $pointer;
    public $wireClick;

    /**
     * Create a new component instance.
     */
    public function __construct(
        $pointer = FALSE,
        $wireClick = [
            'method' => NULL,
            'param' => NULL
        ],
        $value = NULL,
        $center = TRUE,
        $br = [],
        $bl = [],
        $bt = [],
        $bb = [],
        $borderStyle = NULL,
        $date = NULL,
        $sticky = FALSE,
        $type = NULL,
        )
    {
        $this->pointer = $pointer;
        $this->wireClick = $wireClick;
        $this->type = $type;
        $this->value = $this->setValue($value);
        $this->center = $center;
        $this->br = $br;
        $this->bl = $bl;
        $this->bt = $bt;
        $this->bb = $bb;
        $this->sticky = $sticky;
        $this->borderStyle = $this->setBorderStyle($borderStyle);
        $date != NULL ? $this->setBackgroundColor($date) : NULL;
        $this->setFontStyle();
        
        
    }

    private function setValue($value){
        if($value == 0 && $this->type == 'hours'){
            return NULL;
        }
        if(substr($value,0,1) == 'A'){
            return AttendanceModel::ABSENCE_REASON_SHT_TXT[substr($value,2)];
        }
        return $value;
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
        if($dayNum<6 && is_null($this->value) && (strtotime($date) < strtotime(date('Y-m-d'))) ){
            $this->bgStyle = '#ff4747';
        }
        if($this->isDateHoliday($date)){
            $this->bgStyle = '#976EDB';
        }
        if(is_numeric($this->value)){
            $this->bgStyle = '#04c90e';
        }
        if($this->value == 'GO'){
            $this->bgStyle = '#00a8ba';
        }
        if($this->value == 'BO'){
            $this->bgStyle = '#f09618';
        }
        if($this->value == 'BL'){
            $this->bgStyle = '#976EDB';
        }
        if($this->value == 'ERR'){
            $this->bgStyle = 'black';
        }
    }

    private function setFontStyle(){
        if(is_numeric($this->value) && $this->value>12 && $this->type == 'hours'){
            $this->textColor = '#ba1000';
            $this->fontWeight = 'bold';
        }
        if($this->value == 'ERR'){
            $this->textColor = 'white';
            $this->fontWeight = 'bold';
        }
        if($this->value == 'GO' || $this->value == 'BO' || $this->value == 'BL' || $this->value == 'GO'){
            $this->fontWeight = 'bold';
        }
    }

    private function isDateHoliday($date){
        $holiday = array('2024-12-25');
        return in_array($date, $holiday);
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.table.time-tracker-table.td');
    }
}

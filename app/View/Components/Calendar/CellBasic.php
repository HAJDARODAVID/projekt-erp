<?php

namespace App\View\Components\Calendar;

use App\Livewire\Domain\Bde\MainWorkReportModules\Attendance\Attendance;
use App\Models\AttendanceModel;
use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class CellBasic extends Component
{
    const WIDTH  = 170;
    const HEIGHT = 95;
    public $properties = [];
    public $data;
    public $w, $h;
    public $class = [];
    public $selected;
    public $attInfo = '';
    /**
     * Create a new component instance.
     */
    public function __construct(
        array $data = [],
        $w = NULL, $h = NULL,
        $selected = FALSE,
    )
    {
        $this->w = $w == NULL ? self::WIDTH : $w; 
        $this->h = $h == NULL ? self::HEIGHT : $h; 
        $this->selected = $selected;
        $this->createProperty($data)
            ->setHeader()
            ->setCellDate()
            ->setAttInfo();
    }

    private function createProperty($data){
        foreach ($data as $name => $value) {
            $this->{$name} = $value;   
        }        
        return $this;
    }

    private function setHeader(){
        if(isset($this->header)){
            if($this->header == TRUE){
                $this->class[] = 'calendar-cell-header-bg-color';
            }
        }
        return $this;
    }

    /**
     * Set the cell background color.
     * This method will add a class for the cell style base on the criteria given.
     */
    private function setCellDate(){
        if(isset($this->cellData)){
            if(isset($this->cellData['date'])){
                if($this->cellData['date']->format('N') > 5){
                    $this->class[] = 'calendar-cell-weekend-bg-color';
                };
                if($this->cellData['date']->format('m') != $this->month){
                    $this->class[] = 'calendar-cell-previous-month-bg-color';
                };
            }
        }
        return $this;
    }

    private function setAttInfo(){
        if(isset($this->cellData)){
            if(isset($this->cellData['att'])){
                $att = $this->cellData['att'];
                $hours = $att->sum('work_hours');
                $aCount = 0;
                foreach($att as $a){
                    if($a->absence_reason != NULL){
                        $aCount++;
                    }
                }
                if(($hours > 0 && $aCount > 0)){
                    return $this->attInfo = 'ERR';
                };
                if($hours > 0){
                    return $this->attInfo = $hours . 'h';
                };
                if($aCount > 0){
                    return $this->attInfo = AttendanceModel::ABSENCE_REASON_SHT_TXT[$att->first()->absence_reason];
                };
            }
        }
        return $this;
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.calendar.cell-basic');
    }

    public function __set($name, $value)
    {
        $this->properties[$name] = $value;
    }
    public function __get($name)
    {
        return $this->properties[$name] ?? null; 
    }
    public function __isset($name) {
        return isset($this->properties[$name]);
    }
}

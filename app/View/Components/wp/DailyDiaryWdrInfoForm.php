<?php

namespace App\View\Components\wp;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class DailyDiaryWdrInfoForm extends Component
{
    public $wdr;
    public $groupLeader;
    public $constSite;
    public $car;
    public$carMileage;
    public $stringLog;
    public $attendance;
    public $attendanceCoOp;
    /**
     * Create a new component instance.
     */
    public function __construct(
        $wdr,
        $groupLeader,
        $constSite,
        $car,
        $carMileage,
        $stringLog,
        $attendance,
        $attendanceCoOp
    )
    {
        $this->wdr = $wdr;
        $this->groupLeader = $groupLeader;
        $this->constSite = $constSite;
        $this->car = $car;
        $this->carMileage = $carMileage;
        $this->stringLog = $stringLog;
        $this->attendance = $attendance;
        $this->attendanceCoOp = $attendanceCoOp;
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.wp.daily-diary-wdr-info-form');
    }
}

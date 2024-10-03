<?php

namespace App\View\Components\Dashboard;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class WeatherCard extends Component
{
    public $hour;
    /**
     * Create a new component instance.
     */
    public function __construct($hour)
    {
        $this->hour = $hour;
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.dashboard.weather-card');
    }
}

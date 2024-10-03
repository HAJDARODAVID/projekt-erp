<?php

namespace App\Livewire\HidroProjekt\Dashboard;

use Livewire\Component;
use App\Services\HidroProjekt\Domain\Api\WeatherForecastService;

class WeatherForecast extends Component
{
    public $weatherData;
    public $lastChange;

    public function mount(){
        $service = new WeatherForecastService;
        $this->weatherData = $service->toArray()->formatArray()->town('Varazdin')->forDashboard()->getTownData();
        $this->lastChange = $service->toArray()->getLastChanged();
    }

    public function render()
    {
        return view('livewire.hidroprojekt.dashboard.weather-forecast');
    }
}

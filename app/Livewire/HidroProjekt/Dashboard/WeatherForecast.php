<?php

namespace App\Livewire\HidroProjekt\Dashboard;

use App\Services\Days;
use Livewire\Component;
use App\Services\HidroProjekt\Domain\Api\WeatherForecastService;

class WeatherForecast extends Component
{
    public $weatherData;
    public $lastChange;
    public $town = 'Zagreb';
    public $dayShort = Days::DAY_NAME_SHORT_HR;
    public $townArray;

    public function mount(){
        $service = new WeatherForecastService;
        $this->weatherData = $service->toArray()->formatArray()->town($this->town)->forDashboard()->getTownData();
        $this->lastChange = $service->toArray()->getLastChanged();
        $this->townArray = $service->getTownArray();
    }

    public function updatedTown(){
        $service = new WeatherForecastService;
        return $this->weatherData = $service->toArray()->formatArray()->town($this->town)->forDashboard()->getTownData();
    }

    public function render()
    {
        return view('livewire.hidroprojekt.dashboard.weather-forecast');
    }
}

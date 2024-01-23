<?php

namespace App\Livewire\HidroProjekt\Wp;

use Livewire\Component;
use App\Services\HidroProjekt\WP\ConstructionSiteService;

class ConstructionSiteFromToDates extends Component
{
    public $dates;
    public $constId;
    public $start_date;
    public $end_date;
    private $constSiteService;

    public function mount(){
        $this->dates=[
            'start_date' => $this->start_date,
            'end_date' => $this->end_date,
        ];
    }

    public function updatedDates($value, $key){
        if($value == ""){
            $value= NULL;
        }
        $this->constSiteService = new ConstructionSiteService;
        $this->constSiteService->updateConstructionSite($this->constId,[
            $key => $value,
        ]);
    }

    public function render()
    {
        return view('livewire.hidroprojekt.wp.construction-site-from-to-dates');
    }
}
